<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        Voting SPA test project
    </title>
<!--    bootstrap 4-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js" crossorigin="anonymous"></script>

</head>
<body>
<header>
    <nav class="navbar fixed-top">
        <div class="container">
            <div class="row w-100 align-items-center">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <p>Voting SPA test project</p>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 text-center">
                    <?php
                    if (empty($_SESSION['login']) or empty($_SESSION['id']))
                    {
                        echo "";
                    }
                    else
                    {
                        echo "<p>".$_SESSION['login']."</p>";
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 text-right">
                    <?php
                    if (empty($_SESSION['login']) or empty($_SESSION['id']))
                    {
                        echo "";
                    }
                    else
                    { ?>
                        <input id="logout" type="button" class="btn" value="logout">
                     <?php } ?>
                </div>
            </div>

        </div>
    </nav>
</header>
<?php
?>