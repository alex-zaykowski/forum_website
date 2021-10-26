<?php
include 'common.php';
session_start();
function error ( $errlog, $errmsg ) {
  error_log("[".$_SERVER["PHP_SELF"]."] error: (".$errmsg.") ".
            $errlog);
  throw new Exception($errmsg);
}

$link = mysqli_connect($HOST,$DBUSER_ADMIN,$DBPASS_ADMIN,$DATABASE);
if ( !$link ) {
	error(mysqli_connect_error(),"Could not connect to database.");
}

if($_SESSION["user"] != null){
	$query = "CALL ADD_BOARD(?,?,?)";
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt,'sss',$_POST["name"], $_SESSION["user"], $_POST["description"]);
	if(mysqli_stmt_execute($stmt)){
  		header("Location: http://localhost:9001/ path to project/");
  		die();
	}else{
		print "ERROR: ";
		print mysqli_error($link);
	}
	
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}
?>
