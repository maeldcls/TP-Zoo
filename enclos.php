<?php
require_once('config/autoload.php');
require_once('config/db.php');

$employe = [
    'name' => 'billi',
    'age' => 34,
    'gender' => 'male'
];
$idEnclos = $_GET['id'];

$enclosmanager = new EnclosManager($bdd);

$enclos = $enclosmanager->findOneEnclos($idEnclos);
$billi = new Employee($employe);
$employeeManager = new EmployeeManager($bdd);

//$employeeManager->covided($idEnclos);



$animalmanager = new AnimalManager($bdd);

if (isset($_POST['animaux']) && $_POST['animaux'] != '') {

    $employeeManager->addAnimalToEnclos($enclos, $_POST['animaux']);
}
if (isset($_POST['remove']) && $_POST['remove'] != '') {

    $employeeManager->removeFromEnclos($enclos, $_POST['remove']);
}
if (isset($_POST['feed']) && $_POST['feed'] != "") {
    $employeeManager->feed($idEnclos);
    echo $employeeManager->feed($idEnclos);
    header("Location: ./enclos.php?id=" . $idEnclos);
}
if (isset($_POST['heal']) && $_POST['heal'] != "") {
    $employeeManager->heal($idEnclos);
    echo '<p>' . $employeeManager->heal($idEnclos) . '</p>';
    header("Location: ./enclos.php?id=" . $idEnclos);
}
if (isset($_POST['wake']) && $_POST['wake'] != "") {
    $employeeManager->wake($idEnclos);
    echo $employeeManager->wake($idEnclos);
    header("Location: ./enclos.php?id=" . $idEnclos);
}
if (isset($_POST['clean']) && $_POST['clean'] != "") {
    $employeeManager->cleaning($enclos);
    echo $employeeManager->cleaning($enclos);
    header("Location: ./enclos.php?id=" . $idEnclos);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/enclos.css">
</head>

<body>
    <style>
        <?php 
        if($enclos->getType() == "earth"){
            echo 'html { background-color: #ac8e78; }';
        } else if($enclos->getType() == "aqua"){
            echo 'html { background-color: #122c64; }';
        } else if($enclos->getType() == "night"){
            echo 'html { background-color: #0c1121; }';
        }
        ?>
        html { background-image: url('<?php echo $enclos->getBackground() ?>'); }
    </style>

    <div class="enclos">
        <div class="main">
            <div class="container">
                <?php
                if (!empty($enclosmanager->animalsInEnclos($idEnclos))) {
                    foreach ($enclosmanager->animalsInEnclos($idEnclos) as $animal) {
                        echo '<div class="card">';
                        echo '<div class="animal">';
                        echo '<img src="' . $animal->getImg() . '">';
                        echo '</div>';
                        echo '<div class="infos">';
                        echo '<p>' . $animal->getName() . ' :</p>';
                        echo '<p>' . $animal->stateHunger() . '</p>';
                        echo '<p>' . $animal->stateSick() . '</p>';
                        echo '<p>' . $animal->stateSleep() . '</p>';
                        echo '</div></div>';
                    }
                } else {
                }
                ?>
            </div>
        </div>
        <div class="aside">

            <div class="statusEnclos">
                <?php
                $enclos = $enclosmanager->statusEnclos($idEnclos);
                echo '<p>Name :' . $enclos->getName() . '</p>';
                echo '<p>Status  :' . $enclos->getCleanliness() . '</p>';
                echo '<p> Population ' . $enclos->getPopulation() . '</p>';
                ?>
            </div>
            <form action="" method="post">
                <label for="animaux">Add</label>
                <select name="animaux">
                    <option value="">-----</option>
                    <?php

                    if (!empty($animalmanager->findAllAnimalsBytype($enclos->getType()))) {
                        foreach ($animalmanager->findAllAnimalsBytype($enclos->getType()) as $animal) {
                            echo '<option value="' . $animal->getId() . '">' . $animal->getName() . '</option>';
                        }
                    }

                    ?>
                </select>
                <input type="submit" value="◯">
            </form>
            <form action="" method="post">
                <label for="remove">Remove</label>
                <select name="remove">
                    <?php
                    if (!empty($enclosmanager->animalsInEnclos($idEnclos))) {
                        foreach ($enclosmanager->animalsInEnclos($idEnclos) as $animal) {
                            echo '<option value="' . $animal->getId() . '">' . $animal->getName() . '</option>';
                        }
                    }

                    ?>
                </select>
                <input type="submit" value="◯">
            </form>

            <form action="enclos.php?id=<?php echo $idEnclos; ?>" method="post">
                <label for="feed">Feed</label>
                <input type="hidden" name="feed" value="true">

                <input type="submit" value="◯">
            </form>

            <form action="enclos.php?id=<?php echo $idEnclos; ?>" method="post">
                <label for="heal">Heal</label>
                <input type="hidden" name="heal" value="true">

                <input type="submit" value="◯">
            </form>

            <form action="enclos.php?id=<?php echo $idEnclos; ?>" method="post">
                <label for="wake">Wake</label>
                <input type="hidden" name="wake" value="true">

                <input type="submit" value="◯">
            </form>

            <form action="enclos.php?id=<?php echo $idEnclos; ?>" method="post">
                <label for="clean">Clean enclos</label>
                <input type="hidden" name="clean" value="true">

                <input type="submit" value="◯">
            </form>


            <div class="return">
                <a href="index.php">Return</a>
            </div>
        </div>
    </div>
</body>

</html>