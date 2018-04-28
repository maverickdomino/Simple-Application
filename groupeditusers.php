<!doctype html>
<html>
<head>
<title>Add/Remove a user</title>
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
print "<form action=\"groupadduser.php\" method=\"post\"><input type=\"hidden\" name='group_name' value='$group_name'><button type=\"submit\" class='btn btn-success btn-lg'>Add a user</button></form>";
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT username FROM users_groups WHERE group_name='$group_name' ORDER BY username";
$result = pg_exec($connect,$query);
$row_num = pg_numrows($result);
print "<table class='table table-bordered table-striped table-hover'><tr><th>Users</th>";
for($i = 0; $i < $row_num; $i++)
{	
	$username = pg_result($result,$i,0);
        print "<tr>";
        print "<td>".(pg_result($result,$i,0));
        print "<td><form action=\"groupdeleteuser.php\" method=\"post\"><input type=\"hidden\" name='group_name' value='$group_name'><input type=\"hidden\" name='username' value='$username'><button type=\"submit\" class='btn btn-danger'>Remove</button></form>";
}
print "</table>";
?>
</body>
</html>
