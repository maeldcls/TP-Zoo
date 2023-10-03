<?php
class Species extends AbstractAnimal{

    private int $id_species;
    private string $species;
    private string $img;
    private string $type;
    private string $scream;
    
    
    
    public function __construct(array $animalData)
    {
        parent::__construct($animalData);
      $this->hydrate($animalData);
      
    }
    
    /**
     * Get the value of species
     */ 
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set the value of species
     *
     * @return  self
     */ 
    public function setSpecies($species)
    {
        $this->species = $species;

        return $this;
    }

    /**
     * Get the value of img
     */ 
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of scream
     */ 
    public function getScream()
    {
        return $this->scream;
    }

    /**
     * Set the value of scream
     *
     * @return  self
     */ 
    public function setScream($scream)
    {
        $this->scream = $scream;

        return $this;
    }
    
    /**
     * Get the value of id_species
     */ 
    public function getId_species()
    {
        return $this->id_species;
    }

    /**
     * Set the value of id_species
     *
     * @return  self
     */ 
    public function setId_species($id_species)
    {
        $this->id_species = $id_species;

        return $this;
    }

    public function stateHunger():string
    {
        if($this->getHunger()){
            return "a faim";
        }else{
            return "pas faim";
        }
    }
    public function stateSick():string
    {
        if($this->getsick()){
            return "malade";
        }else{
            return "pas malade";
        }
    }
    public function stateSleep():string
    {
        if($this->getSleep()){
            return "dors";
        }else{
            return "dors pas";
        }
    }

    public function hydrate(array $animalData)
    {
        if (isset($animalData["id_species"])) {
            $this->setIdSpecies($animalData["id_species"]);
        }
        if (isset($animalData["species"])) {
            $this->setSpecies($animalData["species"]);
        }
        if (isset($animalData["img"])) {
            $this->setImg($animalData["img"]);
        }
        if (isset($animalData["type"])) {
            $this->setType($animalData["type"]);
        }
        if (isset($animalData["scream"])) {
            $this->setScream($animalData["scream"]);
        }
    }

}