<html>
	<head>
		<link rel="stylesheet" type="text/css" href="try/css/style1.css"/>
		<title>sign in</title>
		<p align="center">please fill in the details</p>
		<script type="text/javascript">
function emptyspace(text1)
{
	alert("please enter  "+text1);
}
function psswd(text2)
{
	alert(text2);
}
function emptyspace1()
{
	alert("file cannot be inserted. a default user picture is used for now.");
}
</script>
		</head>	
		<div class="background1">
<?php

if (isset($_POST['submit'])) {//if submitted

//echo "submitted";
//die();
define('GW_UPLOADPATH', 'images/');
require_once('connection.php');
$email=$_POST['email'];
$name=$_POST['name'];
$sex1=$_POST['gender'];
$occup=$_POST['occup'];
$age=$_POST['age'];
$interest=$_POST['interest'];
$password=$_POST['password'];
$password2=$_POST['password2'];
$profpic=$_FILES['profpic']['name'];
$target = GW_UPLOADPATH . $profpic;
$output_form = false;
echo $profpic;
/* echo $target; */
if(empty($profpic))
{
$profpic="images/user.png";
//echo "default taken";
}
/* else{
	$target = GW_UPLOADPATH . $profpic;
	
	} */
	
	//echo "here";

if(empty($email)||empty($name)||empty($occup)||empty($age)||empty($interest)||empty($password)||empty($password2))
{
//echo "something is empty";
if(empty($email)) {echo "<script type='text/javascript'> var x='email'; emptyspace(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}

if(empty($name)) {echo "<script type='text/javascript'> var x='name'; emptyspace(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}

if(empty($sex1)) {echo "<script type='text/javascript'> var x='sex'; emptyspace(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}

if(empty($occup)) {echo "<script type='text/javascript'> var x='occupation'; emptyspace(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}

if(empty($age)) {echo "<script type='text/javascript'> var x='age'; emptyspace(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}


if(empty($interest)) {echo "<script type='text/javascript'> var x='interest'; emptyspace(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}

if(empty($password)) {echo "<script type='text/javascript'> var x='in both the password fields'; emptyspace(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}

if(empty($password2)) {echo "<script type='text/javascript'> var x='in both the password fields'; emptyspace(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}
}
//if  anything is empty

else{
	
	if (!move_uploaded_file($_FILES['profpic']['tmp_name'], $target)) 
	{
		//echo "not moved";
		echo $profpic;
		echo "<script type='text/javascript'> emptyspace1();</script>"."</ br>";
		//$output_form = true;
		//goto emptyinput;
		$profpic="images/def_usr.png";
		$target="images/def_usr.png";
		/* if (!move_uploaded_file($profpic, $target)) 
		{
		echo "<script type='text/javascript'> emptyspace1();</script>"."</ br>";
		$output_form = true;
		goto emptyinput;
		} */
	}
	
	
if($password==$password2) 
{
$password_enc=sha1($password);
$query1="insert into users values('$email','$name','$sex1','$occup','$age','$interest','$target')";
$query2="insert into login values('$email','$password_enc')";
$result1=mysqli_query($var1,$query1); //or die('error in querying..... user table cannot insert'.mysqli_error($var1));
if(!$result1)
{
	echo "<script type='text/javascript'> var x='the mail id you want to enter is already registered!!'; psswd(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}
$result2=mysqli_query($var1,$query2); //or die('error in querying..... login table cannot insert'.mysqli_error($var1));
if(!$result2)
{
	echo "<script type='text/javascript'> var x='the mail id you want to enter is already registered!!'; psswd(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}
//redirecting........
header('Location:index.php');
}
//password==password ends
else 
{
	echo "<script type='text/javascript'> var x='passwords do not match'; psswd(x);</script>"."</ br>";
$output_form = true;
goto emptyinput;
}
}
mysqli_close($var1);
emptyinput:
}//isset of submit ends

else
{
$output_form = true;
}
if ($output_form) {
?>
	<body>
	<div align="center">
	<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<table>
	<tr>
	<td>
	<p><b>your email id:</b></p>
	</td>
	<td><input type="text"  id="email" name="email" value="<?php if(!empty($email)) echo $email; ?>" placeholder="  ex:username@example.com"/></td>
	</tr>
	<tr>
	<td>
	<p><b>your name:</b></p>
	</td>
	<td><input type="text"  id="name" name="name" value="<?php if(!empty($name)) echo $name; ?>" placeholder="  your name"/></td>
	</tr>
	
	<tr>
	<td>
	<p><b>you are a:</b></p>
	</td>
	<td><input type="radio" name="gender" value="male" /> Male<br />
	<input type="radio" name="gender" value="female" checked/> Female</td>
	</tr>
	
	<tr>
	<td>
	<p><b>about your occupation:</b></p>
	</td>
	<td><input type="text"  id="occup" name="occup" value="<?php if(!empty($occup)) echo $occup; ?>" placeholder="  what do you do for living?"/></td>
	</tr>
	<tr>
	<td>
	<p><b>your age:</b></p>
	</td>
	<td><input type="text"  id="age" name="age" value="<?php if(!empty($age)) echo $age; ?>" placeholder="  how old are you?"/></td>
	</tr>
	<tr>
	<td>
	<p><b>your interests:</b></p>
	</td>
	<td><input type="text"  id="interest" name="interest" value="<?php if(!empty($interest)) echo $interest; ?>" placeholder="  what are you interested in?"/></td>
	</tr>
	<tr>			
	<td><p><b>password required:</b></p></td>
	<td><input type="password"  id="password" name="password" value="<?php if(!empty($password)) echo $password; ?>"/></td>
	</tr>
	<tr>			
	<td><p><b>re-type your password:</b></p></td>
	<td><input type="password"  id="password2" name="password2" value="<?php if(!empty($password2))echo $password2; ?>"/></td>
	</tr>
	<tr>
	<td><input type="file" id="profpic" name="profpic" /><br/><p style='font-size:11px'>(max size is 1MB. If you dont upload any file, a default image will be used for your profile)</p></td>
	</tr>
	<tr>	
	<td><input class="button1" type="submit" value="submit" name="submit" /></td>
	</tr>
	<tr><td><p>already have an account? then login</p><a href="index.php">here</a></td></tr>
	</table>
	</form>
</div>
</body>
</html>
<?php
}
?>
