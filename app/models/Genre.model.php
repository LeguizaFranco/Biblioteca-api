<?php

require_once './app/models/Model.php';

class GenreModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Método para obtener un género por su ID
    public function getGenreById($id_genero)
    {
        $sql = 'SELECT * FROM genero WHERE id_genero = ?';
        $query = $this->db->prepare($sql);
        $query->execute([$id_genero]);  // Pasamos el parámetro correctamente
        return $query->fetch(PDO::FETCH_OBJ);  // Devuelve el género correspondiente al ID
    }

    // Método para insertar un género por su ID
    public function insertGenre($genero, $descripcion, $generos_relacionados, $nivel_popularidad)
    {
        $sql = 'INSERT INTO genero(genero, descripcion, generos_relacionados, nivel_popularidad) VALUES (?, ?, ?, ?)';
        $query = $this->db->prepare($sql);
        $query->execute([$genero, $descripcion, $generos_relacionados, $nivel_popularidad]);

        $id = $this->db->lastInsertId();

        return $id;
    }

    // Método para eliminar un género por su ID
    public function eraseGenre($id_genero)
    {
        $sql = 'DELETE FROM genero WHERE id_genero = ?';
        $query = $this->db->prepare($sql);
        $query->execute([$id_genero]);
    }
}
