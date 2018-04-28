<script>
function func2()
{
window.alert("Error");
location.href='grouplist.php';
}

function func3()
{
window.alert("Group successfully edited");
location.href='grouplist.php';
}
function func4()
{
location.href='grouplist.php';
}


</script>
<?php
if($_POST['group_name']==null)
        print "<script>func4();</script>";

include "haslo.php";

$group_name = $_POST['group_name'];
$grp = $_POST['grp'];

$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");


$query = "UPDATE groups SET name='$group_name' WHERE name='$grp'";
$result = pg_exec($connect,$query);
if(pg_affected_rows($result)==0)
        print "<script>func2();</script>";
else
        print "<script>func3();</script>";






?>


