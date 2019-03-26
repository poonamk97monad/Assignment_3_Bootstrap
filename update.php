<?php

include('Connection.php');
session_start();
  if(!isset($_SESSION['userid'])) {
      # redirect to the login page
      header('Location: index.php?msg=' . urlencode('Login first.'));
      exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assignment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="home.css">
    <script type="text/javascript">
        function validUpdateForm() {
            var strFirstName  = document.forms["updateform"]["fname"];
            var strLastName   = document.forms["updateform"]["lname"];
            var strEmail      = document.forms["updateform"]["email"];
            var intPhone      = document.forms["updateform"]["phone"];
            var strAbout      = document.forms["updateform"]["about"];
            var strUserType   = document.forms["updateform"]["usertype"];

            if ("" == strFirstName.value) {
                window.alert("Please enter your First name.");
                strFirstName.focus();
                return false;
            }
            if ("" == strLastName.value) {
                window.alert("Please enter your last name.");
                strLastName.focus();
                return false;
            }
            //validate email
            if ("" == strEmail.value) {
                window.alert("Please enter a valid e-mail address.");
                strEmail.focus();
                return false;
            }
            if (strEmail.value.indexOf("@", 0) < 0) {
                window.alert("Please enter a valid e-mail address.");
                strEmail.focus();
                return false;
            }
            if (strEmail.value.indexOf(".", 0) < 0) {
                window.alert("Please enter a valid e-mail address.");
                strEmail.focus();
                return false;
            }
            if ("" == intPhone.value) {
                window.alert("Please enter your telephone number.");
                intPhone.focus();
                return false;
            }
            if ("" == strAbout.value) {
                window.alert("Please enter something about you ");
                strAbout.focus();
                return false;
            }
            if ("" == strUserType.value) {
                window.alert("Please select usertype ");
                strUserType.focus();
                return false;
            }

        }


        $(function() {
            $('#user_type').change(function() {
                var data= $(this).val();
                if(data == "Student") {
                    $("#teacher").hide();
                    $("#student").show();
                }
                if(data == "Teacher") {
                    $("#student").hide();
                    $("#teacher").show();
                }
                if(data == null) {
                    $("#student").hide();
                    $("#teacher").hide();
                }
            });
            $('#user_type')
                .val('two')
                .trigger('change');
        });

    </script>

</head>
<body class="bg-dark text-light">
  <!--navigation bar-->
  <nav class="navbar navbar-expand-md bg-secondary navbar-dark ">
      <a class="navbar-brand" href="#">
          <img src="img/monad.png" class="rounded-circle"  alt="logo" style="width:40px;">
      </a>
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" href="home.php" >Home</a>
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
  </nav>
  <!--body-->
  <div class="container-fluid" >
      <div class="row">
          <div class="col-sm-5">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="card text-center view-title ">
                          <h3>Update Details</h3>
                      </div>
                  </div>
              </div>
              <div class="formtext">
                  <form method="post" action="check.php" onsubmit="return validUpdateForm()" name="updateform" id="updateform">
                      <input type="text"  value="<?php echo $_GET['id']?>" class="uphidden" name="id">
                      <div class="form-group">
                          <label>First name:</label>
                          <input type="text" class="form-control" name="fname" value="<?php echo $_GET['fname'];?>" placeholder="your 1st name" id="fname" >
                          <span class = "error">*<?php echo $strFirstNameErr;?></span>
                      </div>
                      <div class="form-group">
                          <label>Last name :</label>
                          <input type="text" class="form-control" name="lname" value="<?php echo $_GET['lname']; ?>"  placeholder="your last name" id="lname">
                          <span class = "error">*<?php echo $strLastNameErr;?></span>
                      </div>
                      <div class="form-group">
                          <label>Email_id:</label>
                          <input type="email" class="form-control" name="email" value="<?php echo $_GET['email']; ?>"  placeholder="someone@gmail.com" id="email">
                          <span class = "error">*<?php echo $strEmailErr;?></span>
                      </div>
                      <div class="form-group">
                          <label>Moblie_no.:</label>
                          <input type="text" class="form-control" name="phone" value="<?php echo $_GET['phone']; ?>" placeholder="99999888888" id="phone">
                          <span class = "error">*<?php echo $strPhoneErr;?></span>
                      </div>
                      <div class="form-group">
                          <label>About:</label>
                          <textarea name="about" class="form-control" rows="3" cols="57" id="about" placeholder="write something about you">
                          <?php echo $_GET['about']; ?></textarea>
                      </div>
                      <div class="form-group uphidden">
                          <label>Password:</label>
                          <input type="password" class="form-control" name="password" value="" placeholder="min lenght 8 "  id="password">
                      </div>
                      <div class="form-group uphidden">
                          <label>Confirm Password:</label>
                          <input type="password" class="form-control" name="repassword" value="" placeholder="re-enter password"  id="repassword">
                      </div>
                      <div class="form-group">
                          <label>User Type:</label>
                          <select id="user_type" name="usertype" class="usertype">
                              <option value="Student" id="stu_id" class="stu_id" >Student</option>
                              <option value="Teacher" id="tea_id" class="tea_id" >Teacher</option>
                          </select>
                      </div>
                      <!--teacher-->
                          <div  id="teacher" class="teacher">
                              <label>Deparment_name:</label>
                              <input type="text" class="form-control" name="deparment_name" value=NUll  placeholder="department_name" ><br><br>
                              <label>Are you HOD:</label>
                              <input type="radio" name="is_hod" value="yes"> YES
                              <input type="radio" name="is_hod" value="no" checked> NO<br><br>
                              <label>Teaching Subjects:</label>
                              <input type="text" class="form-control" name="teaching_subjects" value=NUll placeholder="teaching_subjects" >
                          </div>
                      <!--student-->
                          <div  id="student" class="student">
                              <label>Class Name:</label>
                              <input type="text" class="form-control" name="class_name" value=NUll placeholder="class_name" ><br><br>
                              <label>Are you MONITOR:</label>
                              <input type="radio" name="is_monitor" value="yes" > YES
                              <input type="radio" name="is_monitor" value="no" checked> NO<br><br>
                              <label>Studying Subjects:</label>
                              <input type="text" class="form-control" name="studying_subjects" value=NUll placeholder="studying_subjects" >
                          </div>

                      <div class="form-group">
                          <input class="btn btn-success" type="submit" value="UPDATE" name="update"/>
                      </div>
                  </form>
              </div>
          </div>
          <div class="col-sm-7">
              <div class="bg-dark text-light">
                  <div id="demo" class="carousel slide mt-5" data-ride="carousel">
                      <!-- Indicators -->
                      <ul class="carousel-indicators">
                          <li data-target="#demo" data-slide-to="0" ></li>
                          <li data-target="#demo" data-slide-to="1" ></li>
                          <li data-target="#demo" data-slide-to="2" ></li>
                          <li data-target="#demo" data-slide-to="3"></li>
                      </ul>
                      <!-- The slideshow -->
                      <div class="carousel-inner text-center">
                          <div class="carousel-item active">
                              <img src="img/img6.png" class="img-fluid" alt="Los Angeles" width="1100" height="500">
                          </div>
                          <div class="carousel-item ">
                              <img src="img/img1.png" class="img-fluid" alt="Los Angeles" width="1100" height="500">
                          </div>
                          <div class="carousel-item">
                              <img src="img/img4.jpg" class="img-fluid" alt="Chicago" width="1100" height="500">
                          </div>
                          <div class="carousel-item">
                              <img src="img/img5.jpg" class="img-fluid" alt="New York" width="1100" height="500">
                          </div>
                      </div>
                      <!-- Left and right controls -->
                      <a class="carousel-control-prev" href="#demo" data-slide="prev">
                          <span class="carousel-control-prev-icon"></span>
                      </a>
                      <a class="carousel-control-next" href="#demo" data-slide="next">
                          <span class="carousel-control-next-icon"></span>
                      </a>
                  </div>
              </div>
              <div id="band" class="container text-center mt-5">
                  <h3>If You Can Dream It You Can Achieve It..</h3>
                  <p><em>......</em></p>
                  <p>“When you are able to shift your inner awareness to how you can serve others, and when you make this the central focus of your life, you will then be in a position to know true miracles in your progress toward prosperity.”.</p>
                  <br>
              </div>
          </div>
      </div>
  </div>
  <!--footer-->
  <div class="jumbotron text-center bg-secondary" >
      <p>Footer</p>
  </div>
</body>
</html>
