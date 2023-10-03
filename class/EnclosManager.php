<?php
class EnclosManager{

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

    public function addEnclos(Enclos $enclos):int 
    {
        $enclos->setCleanliness($this->randomState());
        $enclos->setPopulation(0);
        $enclos->setBackground($this->backgroundSelector($enclos->getType()));
        $req = $this->getDb()->prepare("INSERT INTO enclos(name,cleanliness,population,background,type) 
        VALUES(:name,:cleanliness,:population,:background,:type)");
        if($req->execute(array(
            'name'=>$enclos->getName(),  
            'cleanliness'=>$enclos->getCleanliness(),
            'population'=>$enclos->getPopulation(),
            'background'=>$enclos->getBackground(), 
            'type'=>$enclos->getType() 
        )));
       
        $id = $this->db->lastInsertId();
        $enclos->setId($id);
        return $id;
    }

    public function backgroundSelector($type)
    {
        if($type == "earth"){
            return './upload/img/earth.png';
        }else if ($type == "aqua"){
            return './upload/img/aqua.png';
        } else if($type== "night"){
            return './upload/img/night.png';
        }
    }

    public function randomState()
    {
        $rand = rand(0,2);
        if($rand == 0){
            return "Clean";
        }else if($rand == 1){
            return "Normal";
        }else{
            return "Dirty";
        }
    }

    public function findAllEnclos(): array|false
    {
        $statement = $this->getDb()->prepare("SELECT * FROM enclos");
        $statement->execute();
        $enclos = $statement->fetchAll();
        $encl = []; 
        foreach($enclos as $e){
            $encl[] = new Enclos($e);
        }
        return $encl;
    }

    public function findOneEnclos($id):Enclos
    {
        $statement = $this->getDb()->prepare("SELECT * FROM enclos WHERE id=$id");
        $statement->execute();
        $enclos = $statement->fetch();
        $enclos = new Enclos($enclos);
        $enclos->setId($id);
        return $enclos;
    }

    public function animalsInEnclos($idEnclos):array|null
    {
        $statement = $this->getDb()->prepare("SELECT * FROM animals JOIN species ON species.id_species = animals.idSpecies WHERE idEnclos=$idEnclos");
        $statement->execute();
        $animals = $statement->fetchAll();
        if(!empty($animals)){
            foreach($animals as $animal){
                $beast = new Species($animal);
                $this->fillSpecies($beast,$animal); 
                $a[] = $beast;
            }
        } else{
            $a = [];
        }
        
        return $a;
    }
    
    public function fillSpecies(Species $beast, array $animal)
    {
        $beast->setName($animal['name']);
        $beast->setId_species($animal['id_species']);
        $beast->setId($animal['id']);
        $beast->setWeight($animal['weight']);
        $beast->setHeight($animal['height']);
        $beast->setAge($animal['age']);
        $beast->setHunger($animal['hunger']);
        $beast->setSleep($animal['sleep']);
        $beast->setSick($animal['sick']);
    }

    public function statusEnclos($idEnclos):Enclos
    {
        $statement = $this->getDb()->prepare("SELECT * FROM enclos WHERE id = $idEnclos");
        $statement->execute();
        $enclos= $statement->fetch();

        $newEnclos = new Enclos($enclos);

        return $newEnclos;
    }

   
   
    
   
   
}