<?php

namespace Fakepokedex\Controller;

use Config\Controller;
use Fakepokedex\Model\PokemonModel;

class PokemonController extends Controller 
{
    private PokemonModel $pokemonModel;

    public function __construct()
    {
        $this->pokemonModel = new PokemonModel();
        parent::__construct();
    }

    // Read all Pokemons
    public function list()
    {
        $pokemonFind = $this->pokemonModel->findAllPokemon();
        $this->sendReponse(200, $pokemonFind);
    }

    // Read a pokemon
    public function read(int $id)
    {
        header('Content-Type: application/json');

        $pokemon =  $this->pokemonModel->findOneById($id);

        if (!$pokemon)
        {
            http_response_code(404);
            return;
        }

        echo json_encode([
            'status' => 200,
            'data' => $pokemon
        ]);
    }

    // Create a pokemon
    public function create() 
    {
            $json = file_get_contents('php://input');
            $pokemonData =json_decode($json, true);
            // var_dump($pokemonData["Type"]);die;

            $isPokemonCreated = $this->pokemonModel->createPokemon($pokemonData["name"], $pokemonData["type"], $pokemonData["gender"], $pokemonData["trainer_id"]);

            $message = "The Pokemon has been created";
            $this->sendReponse(200, [], $message);
            
            
    }

    // Update a pokemon
    public function update(int $id)
    {
        $json = file_get_contents('php://input');
        $pokemonData = json_decode($json, true);

        $isPokemonUpdated = $this->pokemonModel->updatePokemon($pokemonData["name"], $pokemonData["type"], $pokemonData["gender"], $pokemonData["trainer_id"] ,$id);

        $message = "The Pokemon has been updated";

            if($isPokemonUpdated) {

            $message = "The Pokemon has been updated";

            }
            
            $this->sendReponse(200, [], $message);
    }



    // Delete a pokemon
    public function delete(int $id)
    {
        $pokemonDelete = $this->pokemonModel->deletePokemon($id);
        
        $message = "The Pokemon doesn't exist";
        if($pokemonDelete) {
            $message = "The Pokemon has been deleted !";
        }
        $this->sendReponse(200, [], $message);


        
        
    }

    private function sendReponse(int $status, array $data = [], ?string $message = null)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: http://127.0.0.1:5500');

        http_response_code($status);

        echo json_encode([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}