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
		width: 900px;
		border: 1px solid black;
		padding: 10px;
		background-color: white;
	}
	.content h1{
		text-align: center;
	}
	.content form{
		width: 40%;
		margin: auto;
		border: 1px solid black;
		padding: 10px;
		margin-bottom: 50px;
		background-color: whitesmoke;
	}
	.content form h2{
		text-align: center;
	}
	.content textarea{
		width: 100%;
	}
	.content #image, #title{
		width: 100%;
	}
	img{
		width: 100px;
		height: 100px;
	}
	table{
		margin: auto;
		width:600px;
	}
	table, tr, td{
		border:1px solid black;
		background-color: whitesmoke;
	}
	td{
		padding: 0px;
		margin: 0px;
	}
	.content td{
		text-align: center; 
    	vertical-align: middle;
    	padding: 10px;
    	margin-right: 10px;
    	margin-bottom: 10px;
	}
	.content td a{
		font-weight: bold;
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
	<?php
	include 'common.php';
	$link = mysqli_connect($HOST,$DBUSER,$DBPASS,$DATABASE);
	if ( !$link ) {
		error(mysqli_connect_error(),"Could not connect to database.");
	}

	$query = "CALL GET_THREADS('".$_GET["board"]."')";
	$stmt = mysqli_prepare($link, $query);
	?>

	<div class="content">
	<a href="http://localhost:9001/cs343f20/az8282/project"><< view boards</a>
	<h1><?php print $_GET["board"]; ?></h1>
		<form action="submitThread.php" method="POST">
  			<h2>Submit Thread:</h2>
  			<label for="title">Title:</label>
  			<input type="text" id="title" name="title" value=""><br><br>
  			<label for="body">Body:</label><br>
  			<textarea id="body" name="body" rows="3" cols="50"></textarea></br><br>
  			<label for="image">Image:</label>
  			<input type="text" id="image" name="image" value=""><br><br>
  	 		<input type="hidden" id="boardID" name="boardID" value="<?php print $_GET["board"];?>">
  			<input type="submit" value="post" id="submit">
  			<a href="http://localhost:9001/cs343f20/az8282/project/login.php">login/sign up to post</a>
		</form>

	<table>
		<tr>
		<?php  
		$count = 0;
		if(mysqli_stmt_execute($stmt)){
			mysqli_stmt_bind_result($stmt, $image, $title, $postID, $body, $score);
			while(mysqli_stmt_fetch($stmt)){ 
				if($count%4 == 0 && $count > 0 ){ 
					print "</tr><tr>";
				}
				?>
					<td>
						<a href="viewthread.php?thread=<?php print $postID; ?>">
						<figure>
						<img src="<?php print $image; ?>"/>
						<figcaption><?php print $title; ?></figcaption></a>
						<figcaption style="font-size: 12px; font-weight: bold;"><?php print "Score: ".$score; ?></figcaption>
						<figcaption style="font-size: 12px;"><?php print "Thread #".$postID; ?></figcaption>
						</figure>
						<p><?php print $body;?></p>
					</td>

				<?php 
				$count++;
				} 
		}else{
			print "<tr><th> Error no threads </th></tr>";
		}
		mysqli_stmt_close($stmt);
		mysqli_close($link);
		?>
		</tr>
	</table>
</div>
</body>
</html>