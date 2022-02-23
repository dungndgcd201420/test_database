<?php

$dbconn = pg_connect("host=localhost dbname=dbaccount user=postgres password=2345");

 // Performing SQL query
$query1 = 'SELECT username FROM account';
$result1 = pg_query($query1);
$query2 = 'SELECT password FROM account';
$result2 = pg_query($query2);

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
  //get username and password from post request
  $uname = $_POST["username"];
  $passwd = $_POST["password"];

  if ($uname = $result1 && $passwd = $result2){
    header('Location: index.php');
  }
  else header('Location: login.php');

}

 
$query = 'SELECT * FROM account';
$result = pg_query($query);

	// Printing results in HTML
echo "<table>\n";
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
}
echo "</table>\n";

// Free resultset
pg_free_result($result);

// Closing connection
pg_close($dbconn);

?>
<!DOCTYPE html> 
<html>
<head>
	<title>Lab Website</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<h1>Login</h1>
</head>
  <body>
  	<div class="container">
  <form action="" method = "post">
    <div class ="firstname">
    <div><label for="fname">First Name</label></div>
    <div><input type="text" name="username" placeholder="Username"></div>
    </div>
    <br>
    <div class="password">
    <div><label for="lname">password</label></div>
    <div><input type="password" name="password" placeholder="Password"></div>
    </div>
    <input type="submit" value="Submit">
  </form>
</div>

  	</div>
  </body>
</html>


