<?php
require_once('config/autoload.php');
require_once('config/db.php');

$employe = [
    'name' => 'roger',
    'age' => 60,
    'gender' => 'male'
];
$employeeManager = new EmployeeManager($bdd);

if (isset($_GET['name']) && $_GET['name'] != '' && isset($_GET['weight']) && $_GET['weight'] != '') {
    $data = [
        'name' => $_GET['name'],
        'weight' => $_GET['weight'],
        'height' => $_GET['height'],
        'age' => $_GET['age']
    ];
    $animal = new Animal($data);
    $animalManager = new AnimalManager($bdd);
    $animalManager->addAnimal($animal, $_GET['species']);

}

if (isset($_GET['name']) && $_GET['name'] != '' && isset($_GET['type']) && $_GET['type'] != '') {
    $data2 = [
        'name' => $_GET['name'],
        'type' => $_GET['type']
    ];

    $enclos = new Enclos($data2);
    $enclosManager = new EnclosManager($bdd);
    $enclosManager->addEnclos($enclos);
}
if (isset($_GET['remove']) && $_GET['remove'] != "") {
    $employeeManager->removeEnclos($_GET['remove']);
}

if (isset($_GET['removeAnAnimal']) && $_GET['removeAnAnimal'] != "") {
    $employeeManager->removeOneAnimal($_GET['removeAnAnimal']);
}
if (isset($_GET['removeAllAnimals']) && $_GET['removeAllAnimals'] != "") {
    $employeeManager->removeAllAnimals($_GET['removeAllAnimals']);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>My Zoo</h1>
    <div class="actions">
        <form action="" method="get">
            <p>Add Animal<p>
                <label for="name">Name :</label>
                <input type="text" name="name">
                <label for="weight">Weight :</label>
                <input type="text" name="weight">
                <label for="height">Height :</label>
                <input type="text" name="height">
                <label for="age">Age :</label>
                <input type="text" name="age">
                <select name="species">
                    <option value="">---</option>
                    <option value="panda">Panda</option>
                    <option value="fish">Fish</option>
                    <option value="owl">Owl</option>
                </select>
                <input type="submit" value="Create">
        </form>

        <form action="" method="get">
            <p>Add Enclos</p>
            <label for="name">Name :</label>
            <input type="text" name="name">
            <label for="type">Type :</label>
            <select name="type">
                <option value="">---</option>
                <option value="earth">Bamboo</option>
                <option value="aqua">UnderWater</option>
                <option value="night">Night Forest</option>
            </select>
            <input type="submit" value="Create">
        </form>

        <form action="" method="get">
            <p>Remove Enclos</p>

            <select name="remove">
            <option value="">---</option>
                <?php

                $allenclos = new EnclosManager($bdd);
                foreach ($allenclos->findAllEnclos() as $e) {
                    echo '<option value="' . $e->getId() . '">' . $e->getName() . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Remove">
        </form>

        <form action="" method="get">
            <p>Remove animal</p>

            <select name="removeAnAnimal">
            <option value="">---</option>
                <?php

                $manager = new EmployeeManager($bdd);
                foreach ($manager->findAllAnimals() as $animal) {
                    echo '<option value="' . $animal->getId() . '">' . $animal->getName() . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Remove">
        </form>  

        <form action="" method="get">
            <p>EMPTY ZOO</p>
            <input type="hidden" name="removeAllAnimals" value="oui">
            <input type="submit" value="REMOVE ALL ANIMALS">
        </form>    
    </div>
    
    <h3>Enclos :</h3>
    <div class="container">
        <?php
        $allenclos = new EnclosManager($bdd);
        foreach ($allenclos->findAllEnclos() as $e) {
            echo '<div>Name enclos :' . $e->getName() . '<a href="enclos.php?id=' . $e->getId() . '"><div class="enclos">
            <img class="background" src="' . $e->getBackground() . '"></div></a></div>';
        }
        ?>
    </div>
</body>

</html>