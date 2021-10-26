<?php
include 'common.php';

function error ( $errlog, $errmsg ) {
  error_log("[".$_SERVER["PHP_SELF"]."] error: (".$errmsg.") ".
            $errlog);
  throw new Exception($errmsg);
}

$link = mysqli_connect($HOST,$DBUSER_ADMIN,$DBPASS_ADMIN,$DATABASE);
if ( !$link ) {
	error(mysqli_connect_error(),"Could not connect to database.");
}

if($_POST["username"] != null && $_POST["password"] != null){
	$query = "INSERT INTO SITEMEMBER(username, email, password, birthday)
    VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($link,$query);
    mysqli_stmt_bind_param($stmt,'ssss',$_POST["username"], $_POST["email"], $_POST["password"], $_POST["birthday"]);
  print $query;
	if(mysqli_stmt_execute($stmt)){
        print $_POST["username"].$_POST["email"].$_POST["password"].$_POST["birthday"];
		session_start();
  		$_SESSION["user"] = $_POST["username"];

  		header("Location: http://localhost:9001/path to project");
  		die();

	}else{
		print "ERROR: ";
		print mysqli_error($link);
	}
	
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}
?>
