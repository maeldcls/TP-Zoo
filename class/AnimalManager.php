<?php

class AnimalManager{

    private PDO $db;
    function __construct(PDO $db) {
        $this->db = $db;
    }

    /**
     * Get the value of db
     */ 
    public function getDb()
    {
        return $this->db;
    }
    
    public function addAnimal(Animal $animal,$species):int 
    {
        //request for the animal table
        $animal->setHunger($this->randomStatus());
        $animal->setSleep($this->randomStatus());
        $animal->setSick($this->randomStatus());

        $req = $this->getDb()->prepare("INSERT INTO animals(name,weight,height,age,hunger,sleep,sick,idSpecies) 
        VALUES(:name,:weight,:height,:age,:hunger,:sleep,:sick,:idSpecies)");
        if($req->execute(array(
            'name'=>$animal->getName(),
            'weight'=>$animal->getWeight(),
            'height'=>$animal->getHeight(),
            'age'=>$animal->getAge(),
            'hunger'=>$animal->gethunger(),
            'sleep'=>$animal->getSleep(),
            'sick'=>$animal->getSick(),
            'idSpecies'=>$this->selectSpecies($species)

        )));
        $animal->setIdSpecies($this->selectSpecies($species));
        $id = $this->db->lastInsertId();
        $animal->setId($id);
    
        return $id;
    }

    public function selectSpecies($species):string
    {
        if($species == "panda"){
            return 1;
        }else if($species =="fish"){
            return 2;
        }else if($species =="owl"){
            return 3;
        }
    }
    public function randomStatus()
    {
        $rand = rand(0,1);
        if($rand == 0){
            return false;
        }
        return true;
    }
    
    
/*
    public function findAllAnimals(): array|false
    {
        $statement = $this->getDb()->prepare("SELECT * FROM animals WHERE idEnclos IS NULL");
        $statement->execute();
        $animals = $statement->fetchAll();

        foreach($animals as $animal){
            $ani = new Animal($animal);
            $liste[] = $ani;
        }
        return $liste;
    }*/

    public function findAllAnimalsBytype($type): array|false
    {
        $statement = $this->getDb()->prepare('SELECT * FROM animals JOIN species ON species.id_species = animals.idSpecies WHERE idEnclos IS NULL AND type ="'. $type . '"');
        $statement->execute();
        $animals = $statement->fetchAll();
        $liste = [];
        foreach($animals as $animal){
            $ani = new Animal($animal);
            $liste[] = $ani;
        }
        return $liste;
    }
    
    
}
