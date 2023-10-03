<?php

abstract class AbstractAnimal{
    protected int $id;
    protected  $name;
    protected string $weight;
    protected string $height;
    protected int $age;
    protected bool $hunger;
    protected bool $sleep;
    protected bool $sick;
    protected int $idSpecies;
    
    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }
    

    /**
     * Get the value of weight
     */ 
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */ 
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get the value of height
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */ 
    public function setHeight($height)
    {
        $this->height = $height;

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
     * Get the value of hunger
     */ 
    public function getHunger()
    {
        return $this->hunger;
    }

    /**
     * Set the value of hunger
     *
     * @return  self
     */ 
    public function setHunger($hunger)
    {
        $this->hunger = $hunger;

        return $this;
    }

    /**
     * Get the value of Sleep
     */ 
    public function getSleep()
    {
        return $this->sleep;
    }

    /**
     * Set the value of Sleep
     *
     * @return  self
     */ 
    public function setSleep($sleep)
    {
        $this->sleep = $sleep;

        return $this;
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
    
    /**
     * Get the value of sick
     */ 
    public function getSick()
    {
        return $this->sick;
    }

    /**
     * Set the value of sick
     *
     * @return  self
     */ 
    public function setSick($sick)
    {
        $this->sick = $sick;

        return $this;
    }
    

    /**
     * Get the value of idSpecies
     */ 
    public function getIdSpecies()
    {
        return $this->idSpecies;
    }

    /**
     * Set the value of idSpecies
     *
     * @return  self
     */ 
    public function setIdSpecies($idSpecies)
    {
        $this->idSpecies = $idSpecies;

        return $this;
    }

    public function eat()
    {
        echo $this->getName() . ' est en train de manger';
        $this->setHunger(100);
        echo $this->getHunger() . ' niveau de faim';
    }

    public function heal():string
    {
        $this->setSick(false);
        return $this->getName() . " a été soigné !";
    }

    public function wake()
    {
        $this->setSleep(false);
        return $this->getName() . " est bien reposé !";
    }
    
    public function characteristic()
    {
        echo "<p>Nom : " . $this->getName() . "</p>";
        echo "<p>Poids : " . $this->getWeight() . "</p>";
        echo "<p>Taille : " . $this->getHeight() . "</p>";
        echo "<p>Age : " . $this->getAge() . "</p>";
        echo "<p>Faim : " . $this->getHunger() . "</p>";
        echo "<p>Fatigue : " . $this->getSleep() . "</p>";
        echo "<p>Maladie : " . $this->getSick() . "</p>";
    }
    
    

    public function hydrate(array $datas)
    {
        if (isset($datas["id"])) {
            $this->setId($datas["id"]);
        }
        if (isset($datas["name"])) {
            $this->setName($datas["name"]);
        }
        if (isset($datas["weight"])) {
            $this->setWeight($datas["weight"]);
        }
        if (isset($datas["height"])) {
            $this->setHeight($datas["height"]);
        }
        if (isset($datas["age"])) {
            $this->setAge($datas["age"]);
        }
        if (isset($datas["hunger"])) {
            $this->setHunger($datas["hunger"]);
        }
        if (isset($datas["sleep"])) {
            $this->setSleep($datas["sleep"]);
        }
        if (isset($datas["sick"])) {
            $this->setSick($datas["sick"]);
        }
        if (isset($datas["idSpecies"])) {
            $this->setIdSpecies($datas["idSpecies"]);
        }
    }

}

?>