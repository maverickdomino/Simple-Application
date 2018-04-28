<script>
function func1()
{
window.alert("Error!");
location.href='userlist.php';
}

function func2()
{
window.alert("You can not remove the user! User belongs to a group!");
location.href='userlist.php';
}

function func3()
{
window.alert("User removed");
location.href='userlist.php';
}

function func4()
{
location.href='userlist.php';
}
</script>
<?php
if($_POST['username']==null)
        print "<script>func4();</script>";

include "haslo.php";
$username = $_POST['username'];
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT * FROM users_groups WHERE username='$username'";
$result = pg_exec($connect,$query);
if(pg_numrows($result)>0)
	print "<script>func2();</script>";
else
{
	$query = "DELETE FROM users WHERE username='$username'";
	$result = pg_exec($connect,$query);
	if(pg_affected_rows($result)==0)
		print "<script>func1();</script>";
	else
		print "<script>func3();</script>";
}
?>
