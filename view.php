<?php

include('Connection.php');
include('User.php');
session_start();

if(!isset($_SESSION['userid'])) {
    # redirect to the login page
    header('Location: index.php?msg=' . urlencode('Login first.'));
    exit();
}
$objUser = new User();
//fetching data
$result = $objUser->getData();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Assignment</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                $('[data-toggle="popover"]').popover();
            });
        </script>
    </head>
    <body class="body-back text-light">
        <!--navigation bar-->
        <nav class="navbar navbar-expand-md bg-secondary navbar-dark ">
            <a class="navbar-brand" href="#">
                <img src="img/monad.png" class="rounded-circle"  alt="logo" style="width:40px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="view.php">View Data</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-right">
                    <li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">My Account
                                <span class="caret"></span></a>
                            <ul class="nav-item dropdown-menu">
                                <li><form action="check.php" method="post"><input class="btn form-control" type="submit" name="logout" value="Logout"></li>
                            </ul>
                        </li>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                    <h2 class="text-center right">My Profile</h2>
                    <div class="card right" >
                        <img src="img/user.jpg" class="card-img-top" alt="Avatar" >
                        <div class="card-body">
                            <h4 class="card-title pname"><?php echo $_SESSION["userid"]; ?></h4>
                            <a href="#" class="btn btn-primary">See Profile</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-center view-title ">
                                <h3>All Users Entry</h3>
                            </div>
                        </div>
                    </div>
                    <table  class=" table table-dark table-striped table-sm">
                        <tr>
                            <table class="table table-dark table-striped table-hover table-sm">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> First Name</th>
                                    <th> Last Name</th>
                                    <th> Emai_ID</th>
                                    <th> Mobile</th>
                                    <th> About</th>
                                    <th> User Type</th>
                                    <th colspan="2"> Action</th>
                                </tr>
                                </thead>
                                <?php
                                foreach ($result as $key => $res) {
                                    echo'<tbody>';
                                    echo'<tr>';
                                    echo'<td>'.$res['id'].'</td>';
                                    echo'<td>'.$res['fname'].'</td>';
                                    echo'<td>'.$res['lname'].'</td>';
                                    echo'<td>'.$res['email'].'</td>';
                                    echo'<td>'.$res['phone'].'</td>';
                                    echo'<td>'.$res['about'].'</td>';
                                    echo'<td>'.$res['usertype'].'</td>';
                                    echo'<td><a name="delete" class="btn btn-danger" href="check.php?idd='.$res["id"].'"> Delete</a></td>';
                                    echo'<td><a class="btn btn-info" href="update.php?id='.$res["id"].'&fname='.$res["fname"].'&lname='.$res["lname"].'&email='.$res["email"].'&phone='.$res["phone"].'&about='.$res["about"].'&usertype='.$res["usertype"].'&class_name='.$res["class_name"].'&is_monitor='.$res["is_monitor"].'&studying_subjects='.$res["studying_subjects"].'&deparment_name='.$res["deparment_name"].'&is_hod='.$res["is_hod"].'&teaching_subjects='.$res["teaching_subjects"].'">Edit</a></td>';
                                    echo'</tr>';
                                    echo'</tbody>';
                                }
                                ?>
                            </table>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!--footer-->
        <div class="jumbotron text-center bg-secondary" >
            <p>Footer</p>
        </div>
    </body>
</html>
