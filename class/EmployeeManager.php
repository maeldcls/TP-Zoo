<?php

class EmployeeManager
{

    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Get the value of db
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }

    public function addAnimalToEnclos(Enclos $enclos, $idAnimal): void
    {
        $idEnclos = $enclos->getId();
        if ($this->isFull($enclos)) {
        } else {
            $req = $this->getDb()->prepare("UPDATE animals SET idEnclos = $idEnclos WHERE id = $idAnimal");
            if ($req->execute(array()));
        }
        $this->updatePopu($enclos);
    }
    public function removeFromEnclos(Enclos $enclos, $idAnimal): void
    {
        if ($this->isEmpty($enclos)) {
            echo "enclos VIDE";
        } else {
            $req = $this->getDb()->prepare("UPDATE animals SET idEnclos = NULL WHERE id = $idAnimal");
            if ($req->execute(array()));
        }
        $this->updatePopu($enclos);
    }

    public function updatePopu(Enclos $enclos): void
    {
        $id = $enclos->getId();
        $statement = $this->getDb()->prepare("SELECT COUNT(*) FROM animals WHERE idEnclos = $id");
        $statement->execute();
        $population = $statement->fetch();
        $popu = $population[0];
        $enclos->setPopulation($popu);

        $req = $this->getDb()->prepare("UPDATE enclos SET population = $popu WHERE id = $id");
        if ($req->execute(array()));
    }

    public function isFull(Enclos $enclos): bool
    {
        if ($enclos->getPopulation() >= 6) {
            return true;
        }
        return false;
    }
    public function isEmpty(Enclos $enclos): bool
    {
        if ($enclos->getPopulation() == 0) {
            return true;
        }
        return false;
    }

    public function feed($idEnclos): string
    {
        $req = $this->getDb()->prepare("UPDATE animals SET hunger = false WHERE idEnclos = $idEnclos");
        if ($req->execute(array()));
        return "Animaux nourris";
    }
    public function heal($idEnclos): string
    {
        $req = $this->getDb()->prepare("UPDATE animals SET sick = false WHERE idEnclos = $idEnclos");
        if ($req->execute(array()));
        return "Animaux malade";
    }
    public function wake($idEnclos): string
    {
        $req = $this->getDb()->prepare("UPDATE animals SET sleep = false WHERE idEnclos = $idEnclos");
        if ($req->execute(array()));
        return "Animaux réveillé";
    }

    //for test only TO BE DELETED
    public function covided($idEnclos): void
    {
        $req = $this->getDb()->prepare("UPDATE animals SET hunger = true WHERE idEnclos = $idEnclos");
        if ($req->execute(array()));
        $req = $this->getDb()->prepare("UPDATE animals SET sick = true WHERE idEnclos = $idEnclos");
        if ($req->execute(array()));
        $req = $this->getDb()->prepare("UPDATE animals SET sleep = true WHERE idEnclos = $idEnclos");
        if ($req->execute(array()));
    }

    public function cleaning(Enclos $enclos):string
    {
        if ($this->isEmpty($enclos)) {
            if ($enclos->getCleanliness() == "Clean") {
                return "Impossible de nettoyer, l'enclos est deja propre";
            } else {
                $enclos->setCleanliness("Clean");
                $clean = $enclos->getCleanliness();
                $id = $enclos->getId();
                $req = $this->getDb()->prepare('UPDATE enclos SET cleanliness = "'.$clean.'" WHERE id = ' .$id);
                $req->execute(array());
                return "enclos nettoye";
            }
        
        }else{
            return "Impossible de nettoyer, l'enclos n'est pas vide";
        }
    }
    
    public function removeEnclos($idEnclos):void
    {
        $this->removeIdEnclos($idEnclos);
        $req = $this->getDb()->prepare("DELETE FROM enclos WHERE id = $idEnclos");
        if ($req->execute(array()));

    }
    private function removeIdEnclos($idEnclos):void
    {
        $req = $this->getDb()->prepare("UPDATE animals SET idEnclos = NULL WHERE idEnclos = $idEnclos");
        if ($req->execute(array()));
    }

    public function findAllAnimals()
    {
        $statement = $this->getDb()->prepare("SELECT * FROM animals");
        $statement->execute();
        $animals = $statement->fetchAll();

        foreach($animals as $animal){
            $ani = new Animal($animal);
            $liste[] = $ani;
        }
        return $liste;
    }
    public function removeOneAnimal($idAnimal):void
    {
        $req = $this->getDb()->prepare("DELETE FROM animals WHERE id = $idAnimal");
        if ($req->execute(array()));
    }
    public function removeAllAnimals():void
    {
        $req = $this->getDb()->prepare("DELETE FROM animals");
        if ($req->execute(array()));

    }
}
