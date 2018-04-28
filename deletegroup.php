<script>
function func1()
{
window.alert("Error!");
location.href='grouplist.php';
}

function func2()
{
window.alert("You can not remove the group! The Group is not empty!");
location.href='grouplist.php';
}

function func3()
{
window.alert("Group removed");
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
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT * FROM users_groups WHERE group_name='$group_name'";
$result = pg_exec($connect,$query);
if(pg_numrows($result)>0)
        print "<script>func2();</script>";
else
{
        $query = "DELETE FROM groups WHERE name='$group_name'";
        $result = pg_exec($connect,$query);
        if(pg_affected_rows($result)==0)
                print "<script>func1();</script>";
        else
                print "<script>func3();</script>";
}
?>

