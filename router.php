<?php

require_once 'libs/Router.php';
require_once 'libs/Response.php';
require_once 'libs/Request.php';

require_once 'app/controllers/Book.api.controller.php';
require_once 'app/controllers/Genre.api.controller.php';

$router = new Router();

#                                LIBROS

$router->addRoute('books/:id',      'GET',     'BookApiController',    'getBookById');
$router->addRoute('books',          'POST',    'BookApiController',    'addBook');
$router->addRoute('books/:id',      'DELETE',  'BookApiController',    'deleteBookById');

#                                GÉNEROS

$router->addRoute('genres/:id',     'GET',     'GenreApiController',   'getGenreById');
$router->addRoute('genres',     'POST',     'GenreApiController',   'addGenre');
$router->addRoute('genres/:id',      'DELETE',  'GenreApiController',    'deleteGenreById');


$router->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
