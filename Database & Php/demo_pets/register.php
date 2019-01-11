<?php

if ($_SERVER['REQUEST_METHOD'] =='POST'){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $password = password_hash($password, PASSWORD_DEFAULT);

    require_once 'connect.php';

	$cek = "SELECT * FROM users WHERE email='$email'";	
	if ( mysqli_num_rows(mysqli_query($conn, $cek)) === 1 ) {
		$result["success"] = "0";
		$result["message"] = "Email has been used!";
        echo json_encode($result);
        mysqli_close($conn);
		
	}else{
		$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

		if ( mysqli_query($conn, $sql) ) {
			$result["success"] = "1";
			$result["message"] = "Register Success!";

			echo json_encode($result);
			mysqli_close($conn);

		} else {

			$result["success"] = "0";
			$result["message"] = "error";

			echo json_encode($result);
			mysqli_close($conn);
		}
	}
}

?>