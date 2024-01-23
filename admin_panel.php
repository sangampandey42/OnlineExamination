<?php
session_start();
if(isset($_SESSION['username']) && isset($_SESSION["usertype"]) && $_SESSION["usertype"]=="Admin" ){
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_index.css">
    <link rel="stylesheet" href="lib/bootstrap.min.css">
    <link rel="stylesheet" href="lib\fontawesome-free-5.15.1-web\css\all.css">
    <title>Document</title>
</head>
<body>
    <div class="container-fluid">
        <div class="container-fluid">
                <div class="btn-group loginbtn" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" id="studentbtn">Student</button>
                    <button type="button" class="btn btn-secondary" id="teacherbtn">Teacher</button>
                    <button type="button" class="btn btn-secondary " id="adminbtn">Admin</button>
                    <button class="btn btn-danger" style="margin-top: 0px; " id="logoutbtn">  Log Out <i class="fas fa-sign-in-alt"></i> </button>
                </div>
                <button type="button" class="btn btn-success loginbtn green" id="loginbtn" disabled>Add user  <i class="fas fa-sign-in-alt"></i></button>
                <img class="tulogo" src="images/tulogo.png" alt="LOGO!" width="25px"><br>
                <a href="admin_panel.php"> <h1  style="display:inline;color: white;">Admin Panel</h1></a>
                
        </div>
        <div class="container">
            
                <div class="titleshowcase " id="titleshowcase">
                    <div >
                            <form id="searchform" method="POST">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input required style="margin-bottom: 10px;" type="text" class="form-control" id="inputID" placeholder='name' name="name">
                                    </div>
                                   
                                    <div class="col-md-2">
                                        
                                    <select name="usertype" id="userType" class="form-control " style="margin-bottom: 10px;">
                                      <option value="studentdata" selected>Student</option>
                                      <option value="teacherdata">Teacher</option>
                                      <option value="admindata">Admin</option>
                                    </select>
                                    </div>
                                    
                                    <div class="col-md-1">
                                        <button id="adminsearch" style="margin-bottom: 10px;" type="submit" class="btn btn-outline-success"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                    </div>
                    <div >
                        <table class="table table-striped table-dark table-responsive-lg " id="resulttable">
                            <thead>
                              <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">name</th>
                                <th scope="col">email</th>
                                <th scope="col">Delete</th>
                              </tr>
                            </thead>
                            <tbody id="table">
                             
                            </tbody>
                          </table>
                    </div>
                
                </div>
                <div class="loginform">
                    <div id="studentform" class="notshown" >
                        <h1>Add Student</h1>
                        <form id="addstudentform" method="POST">
                          <div class="form-group">
                            <label for="Inputname1">Name</label>
                            <input type="text" name="name" class="form-control" id="Inputname1"  maxlength="25" minlength="5" required>
                          </div>
                            <div class="form-group">
                              <label for="InputEmail1">Email address</label>
                              <input type="email" name="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                              <label for="InputPassword1">Password</label>
                              <input type="password" name="pass" class="form-control" id="InputPassword1" required minlength="8">
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                          </form>
                    </div>
                    <div id="teacherform" class="notshown">
                        <h1>Add Teacher</h1>
                        <form id="addteacherform" method="POST">
                          <div class="form-group">
                            <label for="Inputname2">Name</label>
                            <input type="text" name="name" class="form-control" id="Inputname2"  maxlength="25" minlength="5" required>
                          </div>
                            <div class="form-group">
                              <label for="InputEmail2">Email address</label>
                              <input type="email" name="email" class="form-control" id="InputEmail2"  aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                              <label for="InputPassword2">Password</label>
                              <input type="password" name="pass" class="form-control" id="InputPassword2" minlength="8" required>
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                          </form>
                    </div>
                    <div id="adminform" class="notshown">
                        <h1>Add Admin</h1>
                        <form id="addadminform" method="POST">
                          <div class="form-group">
                            <label for="Inputname3">Name</label>
                            <input type="text" name="name" class="form-control" id="Inputname3"  maxlength="25" minlength="5" required>
                          </div>
                            <div class="form-group">
                              <label for="InputEmail3">Email address</label>
                              <input type="email"name="email" class="form-control" id="InputEmail3" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                              <label for="InputPassword3">Password</label>
                              <input type="password" name="pass" class="form-control" id="InputPassword3" minlength="8" required>
                            </div>
                            <button type="submit" class="btn btn-success">Add</button>
                          </form>
                    </div>
                </div>

        </div>
    </div>
<script type="text/javascript" src="lib\jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="admincontrol.js"></script>
</body> 
</html>

<?php
}
else{
  header("location:index.php");
}
?>