<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

$router = new Bramus\Router\Router();

// Pokemons
$router->get('/pokemons', 'Fakepokedex\Controller\PokemonController@list');
$router->get('/pokemons/(\d+)', 'Fakepokedex\Controller\PokemonController@read');
$router->post('/pokemons', 'Fakepokedex\Controller\PokemonController@create');
$router->put('/pokemons/(\d+)', 'Fakepokedex\Controller\PokemonController@update');
$router->delete('/pokemons/(\d+)', 'Fakepokedex\Controller\PokemonController@delete');

// Trainers
$router->get('/trainers', 'Fakepokedex\Controller\TrainerController@list');
$router->get('/trainers/(\d+)', 'Fakepokedex\Controller\TrainerController@read');
$router->post('/trainers', 'Fakepokedex\Controller\TrainerController@create');
$router->put('/trainers/(\d+)', 'Fakepokedex\Controller\TrainerController@update');
$router->delete('/trainers/(\d+)', 'Fakepokedex\Controller\TrainerController@delete');

$router->run();