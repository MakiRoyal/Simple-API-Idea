<?php

namespace Fakepokedex\Controller;

use Config\Controller;
use Fakepokedex\Model\TrainerModel;

class TrainerController extends Controller 
{
    private TrainerModel $trainerModel;

    public function __construct()
    {
        $this->trainerModel = new TrainerModel();
        parent::__construct();
    }

    // Read all Trainers
    public function list()
    {
        $trainersFind = $this->trainerModel->findAllTrainer();
        $this->sendReponse(200, $trainersFind);
    }


    // Read a trainer
    public function read(int $id)
    {
        header('Content-Type: application/json');

        $trainer =  $this->trainerModel->findOneById($id);

        if (!$trainer)
        {
            http_response_code(404);
            return;
        }

        echo json_encode([
            'status' => 200,
            'data' => $trainer
        ]);
    }

    // Create a trainer
    public function create() 
    {
            $json = file_get_contents('php://input');
            $trainerData =json_decode($json, true);
            // var_dump($pokemonData["Type"]);die;

            $isTrainerCreated = $this->trainerModel->createTrainer($trainerData["trainerName"], $trainerData["wallet"], $trainerData["trainerGender"]);

            $message = "The Trainer has been created";
            $this->sendReponse(200, [], $message);
            
            
    }

    // Update a trainer
    public function update(int $id)
    {
        $json = file_get_contents('php://input');
        $trainerData = json_decode($json, true);

        $isTrainerUpdated = $this->trainerModel->updateTrainer($trainerData["trainerName"], $trainerData["type"], $trainerData["trainerGender"] , $id);

        $message = "The Trainer has been updated";

            if($isTrainerUpdated) {

            $message = "The Trainer has been updated";

            }
            
            $this->sendReponse(200, [], $message);
    }



    // Delete a trainer
    public function delete(int $id)
    {
        $trainerDelete = $this->trainerModel->deleteTrainer($id);
        
        $message = "The Trainer doesn't exist";
        if($trainerDelete) {
            $message = "The Trainer has been deleted !";
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