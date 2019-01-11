<?php 

header("Content-Type: application/json; charset=UTF-8");

require_once 'connect.php';

$key = $_POST['key'];
$id      = $_POST['id'];
$picture = $_POST['picture'];

if ( $key == "delete" ){

    $query = "DELETE FROM pets WHERE id='$id' ";

        if ( mysqli_query($conn, $query) ){			
			$iparr = explode("/", $picture);
            $picture_split = $iparr[5];
			
			unlink("pets_picture/".$picture_split);

			$result["value"] = "1";
			$result["message"] = "Success!";
			echo json_encode($result);
			mysqli_close($conn);

        } else {

            $response["value"] = "0";
            $response["message"] = "Error!".mysqli_error($conn);
            echo json_encode($response);

            mysqli_close($conn);
        }

} else {
    $response["value"] = "0";
    $response["message"] = "Error!".mysqli_error($conn);
    echo json_encode($response);

    mysqli_close($conn);
}

?>