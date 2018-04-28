<!doctype html>
<html>
<head>
<title>Edit user</title>
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
include "haslo.php";
print " <ul class='pager'>
  <li class='previous'><a href='userlist.php'>Back to user list</a></li>
</ul> ";

if($_POST['username']==null)
        print "<script>func4();</script>";

$username = $_POST['username'];
$connect = pg_connect("host=sbazy user=s193140 dbname=s193140 password=$h");
$query = "SELECT * FROM users WHERE username='$username'";
$result = pg_exec($connect,$query);
$password = pg_result($result,0,1);
$first_name = pg_result($result,0,2);
$last_name = pg_result($result,0,3);
$date = pg_result($result,0,4);

print "<form action='edituser2.php' method='post'>
<input type=\"hidden\" name=\"usr\" value='$username'>
<div class='form-group'>
<label for='username'>Username:</label>
<input type='text' class='form-control' id='username' name='username' value='$username' required maxlength='30'>
</div>
<div class='form_group'>
<label for='password'>Password:</label>
<input type='text' class='form-control id='password' name='password' value='$password' pattern='.{6,}' title='6 to 30 characters' maxlength='30' required><br>
</div>
<div class='form_group'>
<label for='first_name'>First name:</label>
<input type='text' class='form-control' id='first_name' name='first_name' value='$first_name' maxlength='30' required><br>
</div>
<div class='form_group'>
<label for='last_name'>Last name:</label>
<input type='text' class='form-control' id='last_name' name='last_name' value='$last_name' maxlength='30' required><br>
</div>
<div class='form_group'>
<label for='date'>Date of birth:</label>
<input type='date' class='form-control' id='date' name='date_of_birth' value='$date' required>
</div><br>
<button type='submit' class='btn btn-primary btn-lg btn-block'>Edit user</button>
</form>
";

?>
</body>
</html>

