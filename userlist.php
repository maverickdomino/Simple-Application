<!doctype html>
<html>
<head>
<title>User list</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<?php
include "haslo.php";
print " <ul class='pager'>
  <li class='previous'><a href='index.html'>Back to menu</a></li>
</ul> ";

print "<a href='adduser.html' class='btn btn-success btn-lg' role='button'>create a user</a>";
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT * FROM users ORDER BY username";
$result = pg_exec($connect,$query);
$row_num = pg_numrows($result);
$col_num = pg_numfields($result);
print "<table class='table table-bordered table-striped table-hover'>";
print "<tr>";
print "<th>Username</th>";
print "<th>Password</th>";
print "<th>First Name</th>";
print "<th>Last Name</th>";
print "<th>Date of birth</th>";
print "<th>Groups</th>";

for($i=0;$i<$row_num;$i++)
{
	print "<tr>";
	for($j=0;$j<$col_num;$j++)
	{
		print "<td>".(pg_result($result,$i,$j));
		if($j == $col_num - 1)
		{
			print "<td>";
			$username = pg_result($result,$i,0);
			$query2 = "SELECT group_name FROM users_groups WHERE username='$username' ORDER BY group_name";
			$result2 = pg_exec($connect,$query2);
			for($k = 0; $k < pg_numrows($result2);$k++)
			{
				print (pg_result($result2,$k,0))."<br>";
			}
 
			print "<td><form action=\"edituser.php\" method=\"post\"><input type=\"hidden\" name='username' value='$username'><button type=\"submit\" class='btn btn-primary'>Edit</button></form>";
			
			print "<td><form action=\"deleteuser.php\" method=\"post\"><input type=\"hidden\" name='username' value='$username'><button type=\"submit\" class='btn btn-danger'>Remove</button></form>";
			
			print "<td><form action=\"usereditgroups.php\" method=\"post\"><input type=\"hidden\" name='username' value='$username'><button type=\"submit\" class='btn btn-success'>Join/Leave a group</button></form>";
			
		}
	}
}

print "</table>";

?>
</body>
</html>
