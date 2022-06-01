<?php

namespace Fakepokedex\Model;

use Config\Model;
use PDO;

class PokemonModel extends Model 
{
    // Read all Pokemons
    public function findAllPokemon() {
        $statement = $this->pdo->prepare("SELECT * FROM `pokemon`");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Read a Pokemon
    public function findOneById(int $id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM pokemon WHERE id = :id');
        $statement->execute([
            'id' => $id
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    // Create a Pokemon
    public function createPokemon(string $name, string $type, string $gender, ?int $trainer_id) {
        $statement = $this->pdo->prepare("INSERT INTO `pokemon` (`name`, `type`, `gender`, `trainer_id`) VALUES (:name, :type, :gender, :trainer_id)");
        $statement->execute([
            "name" => $name,
            "type" => $type,
            "gender" => $gender,
            "trainer_id" => $trainer_id
        ]);
    }

    // Update a Pokemon
    public function updatePokemon(string $name, string $type, string $gender, ?int $trainer_id, int $id) {
        $statement = $this->pdo->prepare("UPDATE `pokemon` SET name = :name, type = :type, gender = :gender, trainer_id = :trainer_id WHERE id = :id");
        $statement->execute([
            "name" => $name,
            "type" => $type,
            "gender" => $gender,
            "trainer_id" => $trainer_id,
            "id" => $id
        ]);
    }

    // Delete a Pokemon
    public function deletePokemon(int $id) {
        $statement = $this->pdo->prepare("DELETE FROM `pokemon` WHERE id = :id");
        return $statement->execute([
            'id' => $id,
        ]);
    }

    
    
}

