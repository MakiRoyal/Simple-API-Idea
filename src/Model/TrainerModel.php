<?php

namespace Fakepokedex\Model;

use Config\Model;
use PDO;

class TrainerModel extends Model {

 // Read all Trainers
 public function findAllTrainer() {
    $statement = $this->pdo->prepare("SELECT * FROM `trainer` INNER JOIN `pokemon` ON `trainer`.`id` = `pokemon`.`trainer_id`");
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

// Read a Trainer
public function findOneById(int $id)
{
    $statement = $this->pdo->prepare('SELECT * FROM trainer WHERE id = :id');
    $statement->execute([
        'id' => $id
    ]);

    return $statement->fetch(PDO::FETCH_ASSOC);
}

// Create a Trainer
public function createTrainer(string $trainerName, float $wallet, string $trainerGender) {
    $statement = $this->pdo->prepare("INSERT INTO `trainer` (`trainerName`, `wallet`, `trainerGender`) VALUES (:trainerName, :wallet, :trainerGender)");
    $statement->execute([
        "trainerName" => $trainerName,
        "wallet" => $wallet,
        "trainerGender" => $trainerGender
    ]);
}

// Update a Trainer
public function updateTrainer(string $trainerName, float $wallet, string $trainerGender, int $id) {
    $statement = $this->pdo->prepare("UPDATE `trainer` SET trainerName = :trainerName, wallet = :wallet, trainerGender = :trainerGender WHERE id = :id");
    $statement->execute([
        "trainerName" => $trainerName,
        "wallet" => $wallet,
        "trainerGender" => $trainerGender,
        "id" => $id
    ]);
}

// Delete a Trainer
public function deleteTrainer(int $id) {
    $statement = $this->pdo->prepare("DELETE FROM `trainer` WHERE id = :id");
    return $statement->execute([
        'id' => $id,
    ]);
}

public function findPokemonById($trainer_id) {
    $statement = $this->pdo->prepare("SELECT * FROM `pokemon` WHERE trainer_id = :trainer_id");
    $statement->execute([
        "trainer_id" => $trainer_id
    ]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

}