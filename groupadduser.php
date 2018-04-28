<!doctype html>
<html>
<head>
<title>Add user</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
function func4()
{
location.href='grouplist.php';
}

</script>
</head>
<body>
<?php
if($_POST['group_name']==null)
        print "<script>func4();</script>";

include "haslo.php";
print " <ul class='pager'>
  <li class='previous'><a href='grouplist.php'>Back to group list</a></li>
</ul> ";

$group_name = $_POST['group_name'];
print "<h1>$group_name</h1>";
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "(select users.username From (users LEFT JOIN users_groups ON users.username = users_groups.username) Where group_name is null OR group_name != '$group_name') EXCEPT (select users.username From (users LEFT JOIN users_groups ON users.username = users_groups.username) WHERE group_name = '$group_name') order by username;";
$result = pg_exec($connect,$query);
$row_num = pg_numrows($result);
if($row_num==0)
        print "<h2>There are no users to add</h2>";
else
        {
        print "<table class='table table-striped table-bordered table-hover'>";
        for($i = 0; $i < $row_num; $i++)
        {
                $username = pg_result($result,$i,0);
                print "<tr><td>".(pg_result($result,$i,0));
                print "<td><form action=\"add.php\" method=\"post\"><input type=\"hidden\" name='username' value='$username'><input type=\"hidden\" name='group_name' value='$group_name'><button type=\"submit\" class='btn btn-success'>Add</button></form>";


        }

print "</table>";
}
?>
</body>
</html>
