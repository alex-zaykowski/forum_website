<?php
session_start();
function error ( $errlog, $errmsg ) {
  error_log("[".$_SERVER["PHP_SELF"]."] error: (".$errmsg.") ".
            $errlog);
  throw new Exception($errmsg);
}
 ?>
<html>
<style>
	.content{
		margin: auto;
		width: 700px;
		border: 1px solid gray;
		padding: 10px;
		background-color: white;
	}
	.content h1{
		text-align: center;
	}
	#boardform{
		margin: auto;
		margin-bottom: 20px;
		margin-top: 20px;
		width: 400px;
		background-color: whitesmoke;
		padding: 10px;
		border: 1px solid lightgrey;
		font-weight: bold;
		color: #474747;
		font-family: "Arial";
	}
	.content table{
		margin: auto;
		width:200px;
		border: 1px solid lightgrey;
		background-color: lightgrey;
		padding: 10px;
		color: #474747;

	}
	.content td{
		text-align: center; 
    	vertical-align: middle;
    	padding: 10px;
    	margin-right: 10px;
    	margin-bottom: 10px;
    	border: 1px solid lightgrey;
    	background-color: whitesmoke;
	}
	.content td a{
		text-decoration: none;
		color: #474747;
	}
	.content td:hover{
		background-color: #e8e8e8;
	}
	a{
		color: dodgerblue;
	}
	body{
		background-image: url("te_gray.gif");
		font-family: "Arial";
		color: #474747;
	}

</style>
<title>Image Board</title>
<body>
	<div class="content">
	<?php
	include 'common.php';
	$link = mysqli_connect($HOST,$DBUSER,$DBPASS,$DATABASE);
	if ( !$link ) {
		error(mysqli_connect_error(),"Could not connect to database.");
	}

	$query = "SELECT name FROM BOARD";
	$stmt = mysqli_prepare($link, $query);
	?>
	<h1>Welcome to Image Board! <br>
	<a style="font-size: 14px;" href="http://localhost:9001/cs343f20/az8282/project/login.php">login/sign up</a>
	</h1>
	<table>
		<tr><th>Boards</th></tr>
		<?php  
		if(mysqli_stmt_execute($stmt)){
			mysqli_stmt_bind_result($stmt, $name);
			while(mysqli_stmt_fetch($stmt)){ ?>
				<tr><td><a href="viewboard.php?board=<?php print $name; ?>"><?php print $name; ?> </a></td></tr>
			<?php }
		}else{
			print "<tr><th> Error no boards found </th></tr>";
		}
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		?>
	</table>
			<form id="boardform" action="createboard.php" method="POST">
  			<h3>Create Board:</h3>
  			<label for="name">Name:</label><br>
  			<input type="text" id="name" name="name" value=""><br><br>
  			<label for="description">Description:</label><br>
  			<textarea id="description" name="description" rows="3" cols="50"></textarea></br><br>
  			<input type="submit" value="post" id="submit">
		</form>
	</div>
</body>
</html>