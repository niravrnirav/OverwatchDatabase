<?php
    session_start();
    require('connect.php');
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header("location: index.php");
    }

    $select_query = 'SELECT * FROM hero';
    $statement = $db->prepare($select_query);
    $statement->execute();
    $status = $statement->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Characters</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="javascript/test.js"></script>
</head>
<body>
    <div class="container">
        <img src="images/overwatch.png" alt="Overwatch">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Overwatch</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><a href="characterList.php">Characters</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            </div>
        </nav> 
        <div>
            <p>List of Playable Heroes. Click for more information</p>
        </div>          
        <table class="table table-bordered sortable" id="sort">
            <thead>
                <tr>
                    <th>Hero</th>
                    <th onclick="sortTable(0)">Name <i class="NameUp"></i><i class="NameDown"></i></th>
                    <th>Role <i class="RoleUp"></i><i class="RoleDown"></i></th>
                </tr>
            </thead>
            <?php foreach($status as $query) :?>
                <tbody>
                    <tr>
                        <?php $var = $query['Image'] . ".png"?>
                        <td><img src=<?="images/".$var?> height="90" width="100"></td>
                        <td><a href="page.php?HeroId=<?=$query['HeroId']?>"><?=$query['Name']?></a></td>
                        <td><a href="page.php?HeroId=<?=$query['HeroId']?>"><?=$query['Role']?></a></td>
                        <td><a href="edit.php?HeroId=<?=$query['HeroId']?>">edit</a></td>
                    </tr>
                </tbody>
            <?php endforeach ?>
        </table>
        <div>
        <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Insert New Hero</button>
        <div id="demo" class="collapse">
            <form action="process.php" class="form-horizontal" action="/action_page.php" method='post' enctype='multipart/form-data'>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="name">Hero Name:</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Hero Name" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="role">Role:</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Role" name="role">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="realName">Real Name:</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Real Name" name="realName">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="occupation">Occupation:</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Occupation" name="occupation">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="age">Age:</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Age" name="age">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="base">Base Of Operations:</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Base Of Operations" name="base">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="affiliation">Affiliation:</label>
                    <div class="col-sm-10">
                        <input class="form-control" placeholder="Affiliation" name="affiliation">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for='image'>Image(only .png):</label>
                    <div class="col-sm-10">
                        <input type='file' name='image' id='image'> 
                    </div>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <input class="btn btn-default" type="submit" name="command" value="Create" />
                    </div>
                </div>
            </form>
        </div>
        <div class="footer-margin">
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <span class="logo"><img src="images/logo.png" height="100" width="170"></span>
                        </div>
                        <div>
                            <ul class="menu">   
                                <li>Web Dev Final Project - Overwatch CMS</li>
                            </ul>
                        </div>
                    </div> 
                </div>
            </footer>
        </div>
    </div>
</body>
</html>