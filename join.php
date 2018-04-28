<script>
function func2()
{
window.alert("Error");
location.href='userlist.php';
}

function func3()
{
window.alert("User joined the group successfully");
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
$group_name = $_POST['group_name'];
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "INSERT INTO users_groups VALUES('$username','$group_name')";
$result = pg_exec($connect,$query);

if(pg_affected_rows($result)==0)
	 print "<script>func2();</script>";
else
        print "<script>func3();</script>";
?>

