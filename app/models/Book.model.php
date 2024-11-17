<?php
require_once './app/models/Model.php';
class BookModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // metodo para obtener un libro por ID con su género
    public function getBookById($id)
    {
        $sql = 'SELECT libro.*, genero.genero AS nombre_genero 
              FROM libro 
              JOIN genero ON libro.id_genero = genero.id_genero
              WHERE libro.id = ?';

        $query = $this->db->prepare($sql);
        $query->execute([$id]);
        $book = $query->fetch(PDO::FETCH_OBJ);
        return $book;
    }

    // metodo para insertar un libro
    public function insertBook($titulo, $sinopsis, $autor, $anio, $id_genero, $imagen_url)
    {
        $sql = 'INSERT INTO libro(titulo, sinopsis, autor, anio_publicacion,id_genero, imagen_url) VALUES (?, ?, ?, ?, ?,?)';
        $query = $this->db->prepare($sql);
        $query->execute([$titulo, $sinopsis, $autor, $anio, $id_genero, $imagen_url]);

        $id = $this->db->lastInsertId();

        return $id;
    }

    // metodo para eliminar un libro
    public function eraseBook($id)
    {
        $sql = 'DELETE FROM libro WHERE id = ?';

        $query = $this->db->prepare($sql);
        $query->execute([$id]);
    }
}
