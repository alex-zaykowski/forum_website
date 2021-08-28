<?php
include 'common.php';

function error ( $errlog, $errmsg ) {
  error_log("[".$_SERVER["PHP_SELF"]."] error: (".$errmsg.") ".
            $errlog);
  throw new Exception($errmsg);
}

$link = mysqli_connect($HOST,$DBUSER,$DBPASS,$DATABASE);
if ( !$link ) {
	error(mysqli_connect_error(),"Could not connect to database.");
}

if($_POST["username"] != null && $_POST["password"] != null){
	$query = "SELECT username FROM SITEMEMBER
    WHERE username ='".$_POST["username"]."' AND password = SHA('".$_POST["password"]."')";
    $stmt = mysqli_prepare($link,$query);

	if(mysqli_stmt_execute($stmt)){
		mysqli_stmt_bind_result($stmt,$username);
		if(mysqli_stmt_fetch($stmt)){
			session_start();
  			$_SESSION["user"] = $username;
  			header("Location: http://localhost:9001/cs343f20/az8282/project");
  			die();
  			
		}else{
			header("Location: http://localhost:9001/cs343f20/az8282/project/login.php");
  			die();
  			print "Incorrect login";
		}

	}else{
		print "ERROR: ";
		print mysqli_error($link);
	}
	
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}
?>