<?php 

session_start();

require 'Functions.php';

if(isset($_POST["login"])){

	$username = $_POST["username"];
	$Password = $_POST["Password"];

	$result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username'");


	if (mysqli_num_rows($result) === 1) {
		
		$row = mysqli_fetch_assoc($result);
		if( password_verify($Password, $row["password"]) ){
			
			$_SESSION["login"] = true;


			header("Location: Index.php");
			exit;
		}
	}
	$error = true;

}



?>
<!DOCTYPE html>
<html>
<head>
	<title>halaman login</title>
</head>
<body>
	<h1>Halaman Login</h1>
	<?php if (isset($error)) : ?>
			<p style="color:red; font-style:italic;">Username / password salah </p>
	<?php endif; ?>

	<form action="" method="post">
		<ul>
			<li>
				<label for="username">Username :</label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="Password">Password :</label>
				<input type="Password" name="Password" id="Password">
			</li>
			<li>
				<button type="submit" name="login"> Masuk </button>
			</li>

		</ul>


	</form>

</body>
</html>