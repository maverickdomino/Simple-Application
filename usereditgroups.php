<!doctype html>
<html>
<head>
<title>Join/Leave a group</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
function func4()
{
location.href='userlist.php';
}
</script>
</head>
<body>
<?php
if($_POST['username']==null)
        print "<script>func4();</script>";

include "haslo.php";
print " <ul class='pager'>
  <li class='previous'><a href='userlist.php'>Back to user list</a></li>
</ul> ";

$username = $_POST['username'];
print "<h1>$username</h1>";
print "<form action=\"joingroup.php\" method=\"post\"><input type=\"hidden\" name='username' value='$username'><button type=\"submit\" class='btn btn-success btn-lg'>Join a group</button></form>";
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT group_name FROM users_groups WHERE username='$username' ORDER BY group_name";
$result = pg_exec($connect,$query);
$row_num = pg_numrows($result);
print "<table class='table table-bordered table-striped table-hover'><tr><th>Groups</th>";
for($i = 0; $i < $row_num; $i++)
{	
	$group_name = pg_result($result,$i,0);
	print "<tr>";
	print "<td>".(pg_result($result,$i,0));
	print "<td><form action=\"leavegroup.php\" method=\"post\"><input type=\"hidden\" name='username' value='$username'><input type=\"hidden\" name='group_name' value='$group_name'><button type=\"submit\" class='btn btn-danger'>Leave</button></form>";
}
print "</table>";



?>
</body>
</html>
