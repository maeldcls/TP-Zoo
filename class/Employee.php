<?php

class Employee{
    private string $name;
    private int $age;
    private string $gender;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }

    

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */ 
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    public function hydrate(array $datas)
    {
        if (isset($datas["name"])) {
            $this->setName($datas["name"]);
        }
        if (isset($datas["age"])) {
            $this->setAge($datas["age"]);
        }
        if (isset($datas["gender"])) {
            $this->setGender($datas["gender"]);
        }
      
    }

    public function examine(Enclos $enclos)
    {
        $enclos->promptEnclos();
        foreach($enclos->getAnimals() as $animal){
            $animal->characteristic();
        }
    }

    public function cleanEnclos(Enclos $enclos)
    {
        if($enclos->getPopulation()>0){
            echo $this->getName() . " ne peut pas nettoyer la cage CAR IL Y A DES ANIMAUX DEDANS";
        } else{
            if($enclos->getCleanliness() == "bonne"){
                echo $this->getName() . "ne peut pas nettoyer la cage, car ELLE EST DAJA PROPRE";
            } else if($enclos->getCleanliness() == "correct"){
                echo $this->getName() . " a nettoyé la cage, elle est IMPECCABLE";
                $enclos->setCleanliness("bonne");
            }else{
                echo $this->getName() . " a nettoyé la cage, elle est ASSEZ PROPRE";
                $enclos->setCleanliness("correcte");
            }
        }
    }

    public function feedAnimals(Enclos $enclos)
    {
        if($enclos->getAnimals()[0]->getSleep() == false){
            echo $this->getName() . " ne peut pas nourrir les animaux car ils dorment !";
        }else if($enclos->getAnimals()[0]->getHunger() == false){
            echo $this->getName() . " ne peut pas nourrir les animaux car ils n'ont pas faim !";
        }else{
            foreach($enclos->getAnimals() as $animal){
                $animal->setHunger(false);
                
            }
            echo $this->getName() . " a nourris les animaux !";
        }
    }
   
}