<?php
$severname ="localhost";
$username ="root";
$password ="";
$database ="signup";

$connection =mysqli_connect($severname, $username, $password, $database);

if ($connection) {
	///echo "you are connected successfuly";
}
else{
	echo "your not connected";
}

$showAlert=false;
$showError=false;
$user=false;


$username ="";
$password="";
$cpassword="";


if ($_SERVER['REQUEST_METHOD'] =="POST") {
	
	$username =$_POST['username'];
	$password =$_POST['password'];
	$cpassword =$_POST['cpassword'];

$uniq="SELECT * FROM `project2login` WHERE username='$username'";
$exist=mysqli_query($connection, $uniq);

$existnum=mysqli_num_rows($exist);

if ($existnum >0) {
    $user=true;
}
else{

	if ($password == $cpassword) {
        $hash=password_hash($password, PASSWORD_DEFAULT);
		$sql="INSERT INTO `project2login` ( `username`, `password`, `dt`) VALUES ( '$username', '$hash', current_timestamp())";
		$result=mysqli_query($connection , $sql);

		if ($result) {
			$showAlert=true;

            header("location:login.php");
		}
		
	}else{
			$showError=true;
		}
    }
}
?>




<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/system.php/style.css">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>signup</title>
</head>
<body>


<?php require 'nav_ber/_navbar.php' ?>
<?php if ($showAlert) {
	echo '<div class="alert alert-success" role="alert">
  your new account cerated successfuly.
</div>';
}
if ($showError) {
	echo '<div class="alert alert-danger" role="alert">
  password not much plecsa entry valid password
</div>';
}

if ($user) {
    echo '<div class="alert alert-danger" role="alert">
  This username  already exist. plecsa entry valid username.
</div>';
}
?>

<div class="sign_up-box">

    <h1>Sign UP</h1>
     <form  action="" method="POST">

    <div class="user-box">
        <input type="text" name="username" required="">
        <label >UserName</label>
    </div>

    <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>

      <div class="user-box">
        <input type="password" name="cpassword" required="">
        <label>Conform Password</label>
      </div>

     <button class="btn btn-primary" type="submit">Login</button>
      <!--<a href="#">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
       Submit 
      </a>  -->
      </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>