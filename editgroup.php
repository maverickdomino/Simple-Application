<!doctype html>
<html>
<head>
<title>Edit group</title>
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
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT * FROM groups WHERE name='$group_name'";
$result = pg_exec($connect,$query);

print "<form action='editgroup2.php' method='post'>
<div class='form-group'>
<label for='group_name'>Group name:</label>
<input type='text' class='form-control' id='group_name' name='group_name' value='$group_name' required maxlength='30'><br><input type='hidden' name='grp' value='$group_name'>
<button type='submit' class='btn btn-primary btn-lg btn-block'>Edit group</button>
</form>
";

?>
</body>
</html>

