<?php
session_start();
function error ( $errlog, $errmsg ) {
  error_log("[".$_SERVER["PHP_SELF"]."] error: (".$errmsg.") ".
            $errlog);
  throw new Exception($errmsg);
}

 ?>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
	.content{
		margin: auto;
		width: 900px;
		border: 1px solid black;
		padding: 10px;
		background-color: whitesmoke;
	}
	.#commentform{
		margin: auto;
		margin-bottom: 20px;
		margin-top: 20px;
		width: 600px;
		background-color: lightgrey;
		padding: 10px;
		border: 4px ridge lightgrey;
	}
	.content #image, #body{
		width: 100%;
	}
	img{
		width: 100px;
		height: 100px;
	}
	table, tr, td{
		border:1px solid black;
	}
	td{
		padding: 10px;
		margin: 0px;
	}
	figure{
		margin-left: 0px;
		padding: 0px;
		float: left;
	}
	#thread{
		margin-left: auto;
  		margin-right: auto;
  		width: 100%
	}
	#comment{
		width: 400px;
		background-color: white;
	}
	#popup{
		display: none;
	}
	.button-container form,
	.button-container form div {
    	display: inline;
	}

	.button-container button {
    	display: inline;
    	vertical-align: middle;
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
</head>
<title>Thread</title>
<body>
	<div class="content">
	<?php
	include 'common.php';
	$link = mysqli_connect($HOST,$DBUSER,$DBPASS,$DATABASE);
	if ( !$link ) {
		error(mysqli_connect_error(),"Could not connect to database.");
	}

	$threadContent =  "SELECT user, image, title, postID, body FROM THREAD WHERE postID='".$_GET["thread"]."'";
	$getThreadContent = mysqli_prepare($link, $threadContent);

	$comments = "SELECT postID, user, body, date, image FROM COMMENT WHERE thread='".$_GET["thread"]."' ORDER BY date ASC";
	$getComments = mysqli_prepare($link, $comments);
	?>
	<table id="thread">
		<?php
		//fetch thread body
		if(mysqli_stmt_execute($getThreadContent)){
			mysqli_stmt_bind_result($getThreadContent, $user, $image, $title, $postID, $body);
			while(mysqli_stmt_fetch($getThreadContent)){?>
				<tr>
					<td>
						<figure>
						<a href="<?php print $image; ?>"><img src="<?php print $image; ?>"/></a>
						<figcaption><?php print "Thread #".$postID."<br>"."Author: ".$user; ?></figcaption>
						</figure>
						<p><?php print $body;?></p>
						<div class="button-container">
						<form action="vote.php" method="POST">
  	 						<input type="hidden" id="postID" name="postID" value="<?php print $_GET["thread"];?>">
  	 						<input type="hidden" id="value" name="value" value="1">
  							<button type="submit" id="submit"><i class="fa fa-thumbs-o-up"></i></button>
						</form>
						<form action="vote.php" method="POST">
  	 						<input type="hidden" id="postID" name="postID" value="<?php print $_GET["thread"];?>">
  	 						<input type="hidden" id="value" name="value" value="-1">
  							<button type="submit" id="submit"><i class="fa fa-thumbs-o-down"></i></button>
						</form>
						</div>
					</td>
				</tr>
			<?php }
		}?>
	</table>
		<form id="commentform" action="submitcomment.php" method="POST">
  			<h3>Comment:</h3>
  			<label for="body">Body:</label><br>
  			<textarea id="body" name="body" rows="3" cols="50"></textarea></br><br>
  			<label for="image">Image:</label><br>
  			<input type="text" id="image" name="image" value=""><br><br>
  	 		<input type="hidden" id="postID" name="postID" value="<?php print $_GET["thread"];?>">
  			<input type="submit" value="post" id="submit">
  			<a href="http://localhost:9001/cs343f20/az8282/project/login.php">login/sign up to comment</a>
		</form>
	<table>
		<?php 
		//fetch comments  
		if(mysqli_stmt_execute($getComments)){
			mysqli_stmt_bind_result($getComments, $post, $user, $body, $date, $image);
			while(mysqli_stmt_fetch($getComments)){ ?>
				<tr><td id="comment">
					<?php if($image != null) {?>
					<figure>
						<a href="<?php print $image; ?>"><img src="<?php print $image; ?>"/></a>
						<figcaption style="font-size: 12px"><?php print $user.": "."#".$post."  ".$date; ?></figcaption>
					</figure>
					<p><?php print $body; ?></p><br>
					<?php }else{?>
						<p><?php print $body; ?></p>
						<p style="font-size: 12px;" ><?php print $user.": "."#".$post."  ".$date; ?></p>
					<?php } ?>
				</td></tr>
			<?php }
		}else{
			print "<tr><th> Error no threads </th></tr>";
		}
		mysqli_stmt_close($getThreadContent);
		mysqli_stmt_close($getComments);
		mysqli_close($link);
		?>
	</table>
</div>
</body>
</html>