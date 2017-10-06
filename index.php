<?php  //Start the Session
session_start();
require('connect.php');
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['username']) and isset($_POST['passwordlama'])){
//3.1.1 Assigning posted values to variables.
    $username = $_POST['username'];
    $password = $_POST['passwordlama'];
    $password=md5($password);
//3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM mhs WHERE username='$username' and password='$password'";

    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 1){
        $_SESSION['username'] = $username;
    }else{
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        $fmsg = "Invalid Login Credentials.";
    }
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    echo "<script>window.open('home.php','_self')</script>";
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-BuKang</title>
    <!-- Include meta tag to ensure proper rendering and touch zooming -->
    <link rel="shortcut icon" href="img/jtif.png" type="image/x-icon" />
    <link rel="stylesheet" href="asset/css/jquery.mobile-1.4.5.min.css">
    <link rel="stylesheet" href="asset/css/jquery.mobile.theme-1.4.5.min.css">
    <link rel="stylesheet" href="asset/css/manual.css">
    <script src="asset/js/jquery-1-11-3.min.js"></script>
    <script src="asset/js/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>

<!--halaman-login-->
<div data-role="page" data-theme="a">
    <!--header-->
    <div data-role="header">
        <h1>E-BuKang</h1>
    </div>
    <!--header-->

    <div data-role="main" class="ui-content center-wrapper">
        <div class="ui-body ui-body-a ui-corner-all">
            <div>
                <img style="width: 100%" src="img/jtif.png">
            </div><br>
            <form method="post">
                <input class="center-wrapper" type="text" name="username" id="nim" placeholder="NIM.."><br>
                <input class="center-wrapper" type="password" name="passwordlama" id="password" placeholder="Password.."><br>
                <input type="submit" class="ui-btn" name="login" value="Masuk">
            </form>
        </div>
        <br>
        <p>Belum terdaftar?<a href="daftar.php"> Daftar disini...</a></p>
    </div>

    <!--footer-->
    <div data-role="footer" data-position="fixed">
        <h1>Copyright &copy; 2017 </h1>
    </div>
    <!--footer-->
</div>


</body>

</html>
<?php } ?>