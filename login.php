<html>
<style type="text/css">
.content{
  text-align: center;
  margin: auto;
  width: 900px;
  border: 1px solid black;
  padding: 10px;
  background-color: white;
}
label{
    width:180px;
    clear:left;
    text-align:right;
    padding-right:10px;
}

label{
    float:left;
}
.content form{
    width: 60%;
    margin: auto;
    border: 1px solid black;
    padding: 10px;
    margin-bottom: 50px;
    background-color: whitesmoke;
  }

#submit{
margin-left: 190px;
margin-top: 20px;
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
<body>
<div class="content">
<h1 >Welcome!</h1>
<form action="dologin.php" method="POST">
  <center><h2>Login:</h2></center>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value=""><br>
  <label for="password">Password:</label>
  <input type="text" id="password" name="password" value=""><br>
  <input type="submit" value="login" id="submit">
</form>

<form action="createaccount.php" method="POST">
  <center><h2>Sign Up:</h2></center>
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value=""><br>
  <label for="password">Password:</label>
  <input type="text" id="password" name="password" value=""><br>
  <label for="email">Email:</label>
  <input type="text" id="email" name="email" value=""><br>
  <label for="birthday">Date of Birth:</label>
  <input type="date" id="birthday" name="birthday" value=""><br>
  <input type="submit" value="create new account" id="submit">
</form>
<a href="http://localhost:9001/cs343f20/az8282/project/">home</a>
</div>
</body>
</html>
