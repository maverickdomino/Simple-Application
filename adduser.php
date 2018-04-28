<script>
function func1()
{
window.alert("Can not create the user - user already exists!");
location.href='adduser.html';
}
function func2()
{
window.alert("Error");
location.href='adduser.html';
}

function func3()
{
window.alert("User successfully created");
location.href='userlist.php';
}


function func4()
{
location.href='userlist.php';
}


</script>
<?php
include "haslo.php";

if($_POST['username']==null)
	print "<script>func4();</script>";
$username = $_POST['username'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$date_of_birth = $_POST['date_of_birth'];

$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT username FROM users WHERE username='$username'";
$result = pg_exec($connect,$query);

if(pg_numrows($result)==1)
	print "<script>func1();</script>";

$query = "INSERT INTO users VALUES ('$username','$password','$first_name','$last_name','$date_of_birth')";
$result = pg_exec($connect,$query);

if(pg_affected_rows($result)==0)
	print "<script>func2();</script>";
else
	print "<script>func3();</script>";






?>

