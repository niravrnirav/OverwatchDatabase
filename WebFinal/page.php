<?php
    require 'connect.php';
    require 'authentication.php';
    $id = filter_input(INPUT_GET, 'HeroId', FILTER_SANITIZE_NUMBER_INT);
    
    $query = "SELECT * FROM detail WHERE HeroId = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute(); 
    $status = $statement->fetch();

    $abilityQuery = "SELECT * FROM ability WHERE HeroId = :idAbility";
    $statement2 = $db->prepare($abilityQuery);
    $statement2->bindValue(':idAbility', $id, PDO::PARAM_INT);
    $statement2->execute(); 
    $abilityStatus = $statement2->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <p>Real Name: <?=$status['RealName']?></p>
    <p>Occupation: <?=$status['Occupation']?></p>
    <p>Age: <?=$status['Age']?></p>
    <p>Base Of Operations: <?=$status['BaseOfOperation']?></p>
    <p>Affiliation: <?=$status['Affiliation']?></p>
    <h1>Abilities</h1>
    <?php if(!empty($abilityStatus)): ?>
        <?php foreach($abilityStatus as $ability): ?>
            <p>ability: <?=$ability['AbilityName']?></p>
            <p>Description: <?=$ability['Description']?></p>
        <?php endforeach?>
    <?php else: ?>
        <p>Ability information unable at the moment.</p>
    <?php endif ?>
</body>
</html>