<?php

require_once './app/models/Book.model.php';
require_once './app/models/Genre.model.php';
require_once './app/views/json.view.php';

class BookApiController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new BookModel();
        $this->view = new JSONView();
    }

    public function getBookById($req)
    {
        // Obtener el id desde los parámetros de la URL
        $id = $req->params->id;
        if (!is_numeric($id) || $id <= 0) {
            return $this->view->response(["error" => "El valor ingresado debe ser numérico y mayor a cero."], 400);
        }

        // Llamar al modelo para obtener el libro
        $book = $this->model->getBookById($id);

        // Si no se encuentra el libro, devolver un error 404
        if (!$book) {
            return $this->view->response(["error" => "No existe el libro con el id=$id"], 404);
        }

        // Devolver el libro con su género
        return $this->view->response($book);
    }

    public function addBook($req)
    {

        // Validar campos requeridos
        if (empty($req->body->titulo) || empty($req->body->autor) || empty($req->body->anio_publicacion) || empty($req->body->id_genero)) {
            return $this->view->response(["error" => "Faltan datos requeridos"], 400);
        }

        // Obtener datos del body
        $titulo = $req->body->titulo;
        $sinopsis = $req->body->sinopsis ?? ''; // opcional
        $autor = $req->body->autor;
        $anio_publicacion = $req->body->anio_publicacion;
        $id_genero = $req->body->id_genero;
        $imagen_url = $req->body->imagen_url ?? ''; // opcional

        // Validar año de publicación (debe ser un número)
        if (!is_numeric($anio_publicacion) || $anio_publicacion < 1900 || $anio_publicacion > date("Y")) {
            return $this->view->response(["error" => "El año de publicación debe ser un número válido entre 1900 y el año actual."], 400);
        }

        // Validar la URL de la imagen si se proporciona
        if (!empty($imagen_url) && !filter_var($imagen_url, FILTER_VALIDATE_URL)) {
            return $this->view->response(["error" => "La URL de la imagen no es válida."], 400);
        }

        // Llamar al modelo para insertar el nuevo libro
        $id = $this->model->insertBook($titulo, $sinopsis, $autor, $anio_publicacion, $id_genero, $imagen_url);

        if ($id) {
            return $this->view->response(["message" => "Libro creado con éxito", "id" => $id], 201);
        } else {
            return $this->view->response(["error" => "Error al crear el libro"], 500);
        }
    }

    public function deleteBookById($req)
    {
        // Obtener el id desde los parámetros de la URL
        $id = $req->params->id;

        // Llamar al modelo para obtener el libro
        $book = $this->model->getBookById($id);

        // Si no se encuentra el libro, devolver un error 404
        if (!$book) {
            return $this->view->response(["error" => "El libro con el id=$id, no existe"], 400);
        }

        // Llamar al modelo para eliminar el libro
        $this->model->eraseBook($id);

        // devuelvo un mensaje de exito 200
        $this->view->response(["message" => "Libro eliminado con éxito", "id" => $id], 200);
    }
}
