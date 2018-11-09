<?php
    require 'connect.php';
    require 'authentication.php';
    $id = filter_input(INPUT_GET, 'HeroId', FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM hero WHERE HeroId = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute(); 
    $status = $statement->Fetch();

    $detailQuery = "SELECT * FROM detail WHERE HeroId = :id";
    $statement2 = $db->prepare($detailQuery);
    $statement2->bindValue(':id', $id, PDO::PARAM_INT);
    $statement2->execute(); 
    $detailStatus = $statement2->Fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Edit</title>
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <form action="process.php" class="form-horizontal" action="/action_page.php" method='post' enctype='multipart/form-data'>
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Hero Name:</label>
            <div class="col-sm-10">
                <input class="form-control" placeholder="Hero Name" name="name" value="<?=$status['Name']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="role">Role:</label>
            <div class="col-sm-10">
                <input class="form-control" placeholder="Role" name="role" value="<?=$status['Role']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="realName">Real Name:</label>
            <div class="col-sm-10">
                <input class="form-control" placeholder="Real Name" name="realName" value="<?=$detailStatus['RealName']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="occupation">Occupation:</label>
            <div class="col-sm-10">
                <input class="form-control" placeholder="Occupation" name="occupation" value="<?=$detailStatus['Occupation']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="age">Age:</label>
            <div class="col-sm-10">
                <input class="form-control" placeholder="Age" name="age" value="<?=$detailStatus['Age']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="base">Base Of Operations:</label>
            <div class="col-sm-10">
                <input class="form-control" placeholder="Base Of Operations" name="base"value="<?=$detailStatus['BaseOfOperation']?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="affiliation">Affiliation:</label>
            <div class="col-sm-10">
                <input class="form-control" placeholder="Affiliation" name="affiliation" value="<?=$detailStatus['Affiliation']?>">
            </div>
        </div>
        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="id" value="<?=$status['HeroId']?>" />
                <input class="btn btn-default" type="submit" name="command" value="Update" />
                <input class="btn btn-default" type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
            </div>
        </div>
    </form>
</body>
</html>