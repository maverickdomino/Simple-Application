<script>
function func2()
{
window.alert("Error");
location.href='adduser.html';
}

function func3()
{
window.alert("User successfully edited");
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
$usr = $_POST['usr'];
$password = $_POST['password'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$date_of_birth = $_POST['date_of_birth'];

$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");


$query = "UPDATE users SET username='$username', password='$password', first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth' WHERE username='$usr'";
$result = pg_exec($connect,$query);

if(pg_affected_rows($result)==0)
        print "<script>func2();</script>";
else
        print "<script>func3();</script>";






?>

