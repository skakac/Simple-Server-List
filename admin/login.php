<?php 
session_start();
if(isset($_SESSION['login']))
	header("Location: ./index.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
   <head>
     <title>Login</title>
   </head>
   <body>
   	<center>
   	<form method="post" action="process.php">
   		<table>
	   		<tr>
	   			<td>Username</td>
	   			<td><input type="text" name="user" /></td>
	   		</tr>
	   		<tr>
	   			<td>Password</td>
	   			<td><input type="password" name="pass" /></td>
	   		</tr>
	   		<tr>
	   			<td><input type="submit" name="login" value="Login"/></td>
	   		</tr>
   		</table>
   	</from>
   	</center>
   </body>
 </html>