<?php

require_once './app/models/Genre.model.php';
require_once './app/views/json.view.php';

class GenreApiController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new GenreModel();
        $this->view = new JSONView();
    }

    public function getGenreById($req)
    {
        // Obtener el id desde los parámetros de la URL
        $id = $req->params->id;
        if (!is_numeric($id) || $id <= 0) {
            return $this->view->response(["error" => "El valor ingresado debe ser numérico y mayor a cero."], 400);
        }

        // Llamar al modelo para obtener el género
        $genre = $this->model->getGenreById($id);

        // Si no se encuentra el género, devolver un error 404
        if (!$genre) {
            return $this->view->response(["error" => "No existe el género con ID=$id"], 404);
        }

        // Devolver el género
        return $this->view->response(["data" => $genre]);
    }
    public function addGenre($req)
    {

        // Validar campos requeridos
        if (empty($req->body->genero) || empty($req->body->descripcion) || empty($req->body->generos_relacionados) || empty($req->body->nivel_popularidad)) {
            return $this->view->response(["error" => "Faltan datos requeridos"], 400);
        }

        // Obtener datos del body
        $genero = $req->body->genero;
        $descripcion = $req->body->descripcion ?? ''; // opcional
        $generos_relacionados = $req->body->generos_relacionados;
        $nivel_popularidad = $req->body->nivel_popularidad;

        // Validar nivel de popularidad (debe ser un número)
        if (!is_numeric($nivel_popularidad) || $nivel_popularidad < 0) {
            return $this->view->response(["error" => "El nivel de popularidad debe ser numerico y mayor a cero."], 400);
        }

        // Llamar al modelo para insertar el nuevo género
        $id = $this->model->insertGenre($genero, $descripcion, $generos_relacionados, $nivel_popularidad);

        if ($id) {
            return $this->view->response(["message" => "Género creado con éxito", "id" => $id], 201);
        } else {
            return $this->view->response(["error" => "Error al crear el género"], 500);
        }
    }

    public function deleteGenreById($req)
    {

        // Obtener el id desde los parámetros de la URL
        $id = $req->params->id;

        // Llamar al modelo para obtener el género
        $genre = $this->model->getGenreById($id);

        // Si no se encuentra el género, devolver un error 404
        if (!$genre) {
            return $this->view->response(["error" => "El género con el id=$id, no existe"], 400);
        }

        // Llamar al modelo para eliminar el género
        $this->model->eraseGenre($id);

        // devuelvo un mensaje de exito 200
        $this->view->response(["message" => "Género eliminado con éxito", "id" => $id], 200);
    }
}
