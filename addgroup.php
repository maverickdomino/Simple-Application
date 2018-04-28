<script>
function func1()
{
window.alert("Can not create the group - group already exists!");
location.href='addgroup.html';
}
function func2()
{
window.alert("Error");
location.href='grouplist.php';
}

function func3()
{
window.alert("Group successfully created");
location.href='grouplist.php';
}
function func4()
{
location.href='grouplist.php';
}

</script>
<?php
include "haslo.php";
if($_POST['group_name']==null)
        print "<script>func4();</script>";

$group_name = $_POST['group_name'];

$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT name FROM groups WHERE name='$group_name'";
$result = pg_exec($connect,$query);

if(pg_numrows($result)==1)
        print "<script>func1();</script>";

$query = "INSERT INTO groups VALUES ('$group_name')";
$result = pg_exec($connect,$query);

if(pg_affected_rows($result)==0)

   	print "<script>func2();</script>";
else
        print "<script>func3();</script>";
?>
