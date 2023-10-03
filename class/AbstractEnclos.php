<?php
abstract class AbstractEnclos{
    protected int $id;
    protected string $name;
    protected string $cleanliness;
    protected int $population;
    protected string $type;
    protected string $background;
    protected array $animals =[];

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
     * Get the value of cleanliness
     */ 
    public function getCleanliness()
    {
        return $this->cleanliness;
    }

    /**
     * Set the value of cleanliness
     *
     * @return  self
     */ 
    public function setCleanliness($cleanliness)
    {
        $this->cleanliness = $cleanliness;

        return $this;
    }

    /**
     * Get the value of population
     */ 
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set the value of population
     *
     * @return  self
     */ 
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }
     /**
     * Get the value of animals
     */ 
    public function getAnimals():array
    {
        return $this->animals;
    }
    /**
     * Set the value of animals
     *
     * @return  self
     */ 
    public function setAnimals($animals)
    {
        $this->animals = $animals;

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
     * Get the value of background
     */ 
    public function getBackground()
    {
        return $this->background;
    }

    /**
     * Set the value of background
     *
     * @return  self
     */ 
    public function setBackground($background)
    {
        $this->background = $background;

        return $this;
    }
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

  public function hydrate(array $datas)
    {
        if (isset($datas["id"])) {
            $this->setId($datas["id"]);
        }
        if (isset($datas["name"])) {
            $this->setName($datas["name"]);
        }
        if (isset($datas["cleanliness"])) {
            $this->setCleanliness($datas["cleanliness"]);
        }
        if (isset($datas["population"])) {
            $this->setPopulation($datas["population"]);
        }
        if (isset($datas["type"])) {
            $this->setType($datas["type"]);
        }
        if (isset($datas["background"])) {
            $this->setBackground($datas["background"]);
        }
        
    }
    public function empty():bool
    {
        if($this->getPopulation() == 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function addAnimalToEnclos(Animal $animal):void
    {
        if($this->getPopulation()>5){
            echo 'Impossible d ajouter des animaux car l enclos est PLEIN !!!';
        }else{
            $animals = $this->getAnimals();
            $animals[] = $animal; 
            $this->setAnimals($animals);
            $this->setPopulation($this->getPopulation()+1);
        }
        
    }

    public function promptEnclos()
    {
        echo "<p>Nom enclos :" . $this->getName()."</p>";
        echo "<p>Propreté de l'enclos :" . $this->getCleanliness()."</p>";
        echo "<p>Population de l'enclos :" . $this->getPopulation()."</p>";
    }


   
}