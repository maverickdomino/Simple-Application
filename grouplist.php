<!doctype html>
<html>
<head>
<title>Group list</title>
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


print "<a href='addgroup.html' class='btn btn-success btn-lg' role='button'>Create a group</a>";

$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT * FROM groups ORDER BY name";
$result = pg_exec($connect,$query);
$row_num = pg_numrows($result);
$col_num = pg_numfields($result);
print "<table class='table table-bordered table-striped table-hover'>";
print "<tr>";
print "<th>Group name</th>";
print "<th>Users</th>";

for($i=0;$i<$row_num;$i++)
{
        print "<tr>";
                print "<td>".(pg_result($result,$i,0));
                        print "<td>";
                        $group_name = pg_result($result,$i,0);
                        $query2 = "SELECT username FROM users_groups WHERE group_name='$group_name' ORDER BY username";
                        $result2 = pg_exec($connect,$query2);
                        for($k = 0; $k < pg_numrows($result2);$k++)
                        {
                                print (pg_result($result2,$k,0))."<br>";
                        }

 			 print "<td><form action=\"editgroup.php\" method=\"post\"><input type=\"hidden\" name='group_name' value='$group_name'><button type=\"submit\" class='btn btn-primary'>Edit</button></form>";                       

			print "<td><form action=\"deletegroup.php\" method=\"post\"><input type=\"hidden\" name='group_name' value='$group_name'><button type=\"submit\" class='btn btn-danger'>Remove</button></form>";               

               		print "<td><form action=\"groupeditusers.php\" method=\"post\"><input type=\"hidden\" name='group_name' value='$group_name'><button type=\"submit\" class='btn btn-success'>Add/Remove a user</button></form>";
 
        
}

print "</table>";

?>
</body>
<html>
