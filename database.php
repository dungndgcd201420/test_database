<?php

$dbconn = pg_connect("host=localhost dbname=dbaccount user=postgres password=12345");

 // Performing SQL query




if ($_SERVER['REQUEST_METHOD'] == "POST")
{
   
//ADD
   if(isset($_POST['add'])) {
         $id= $_POST['id'];
         $shopname = $_POST ['shopname'];
        $productname = $_POST['productname'];
          
          $query = "INSERT INTO product (productid, shopname, productname) VALUES 
          ($id, '".$shopname."', '".$productname."')";

          $result = pg_query($dbconn, $query);
    //UPDATE   
    }
     if(isset($_POST['update'])) {
         $id= $_POST['id2'];
         $shopname = $_POST ['shopname2'];
         $productname = $_POST['productname2'];
          
          $query3 = "UPDATE product 
          SET 
          shopname = '".$shopname."', productname = '".$productname."'
          WHERE productid = $id";

          $result3 = pg_query($dbconn, $query3);
         
    }

    //DELETE
      if(isset($_POST['delete'])) {
         $id= $_POST['id3'];
          $query4 = "DELETE FROM product WHERE productid = $id";
          $result4 = pg_query($dbconn, $query4);
         
    }
}

$query1 = "SELECT * FROM product ORDER BY productid";
$result1 = pg_query($dbconn, $query1);



//Styling Table
echo "<div class='table'>";
//TABLE
echo "<table border='2'>\n";

//TABLE HEADER
$i =0;
while ($i < pg_num_fields($result1))
{
  $fieldName = pg_field_name($result1, $i);
  echo '<td>' . $fieldName . '</td>';
  $i = $i + 1;
}


//TABLE
while ($line = pg_fetch_array($result1, null, PGSQL_ASSOC)) {
    echo "<tr>";
    foreach ($line as $col_value) {
        echo "<td>$col_value</td>";
    }
    echo "</tr>";
}
echo "</table>";

echo "</div>";

// Closing connection
pg_close($dbconn);

?>

<!DOCTYPE html> 
<html>
<head>
  <title>Database</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
  <body>
    <div class ="form-container">
    <!-- ADD -->
    <div class ="container">
       <h1>Add</h1>
     <form action="" method = "post">
      <div class ="id">
    <div><label for="">ID</label></div>
    <div><input type="text" name="id" placeholder="id"></div>
    </div>
    <div class ="shopname">
    <div><label for="">Shop Name</label></div>
    <div><input type="text" name="shopname" placeholder="Shop Name"></div>
    </div>
    <br>
    <div class="shopname">
    <div><label for="">Product Name</label></div>
    <div><input type="text" name="productname" placeholder="Product Name"></div>
    </div>
    <input type="submit" name="add" value="Add">
  </form>
    </div>
   
    <div class ="container">
       <h1>Update</h1>
<!-- UPDATE -->
 <form action="" method = "post">
      <div class ="id">
    <div><label for="">ID</label></div>
    <div><input type="text" name="id2" placeholder="id"></div>
    </div>
    <div class ="shopname">
    <div><label for="">Shop Name</label></div>
    <div><input type="text" name="shopname2" placeholder="Shop Name"></div>
    </div>
    <br>
    <div class="shopname">
    <div><label for="">Product Name</label></div>
    <div><input type="text" name="productname2" placeholder="Product Name"></div>
    </div>
    <input type="submit" name="update" value="Update">
  </form> 
</div>

<div class ="container">
  <h1>Delete</h1>
  <form action="" method = "post">
      <div class ="id">
    <div><label for="">ID</label></div>
    <div><input type="text" name="id3" placeholder="id"></div>
    <input type="submit" name="delete" value="Delete">
  </form> 
  </div>
</div>

  </body>
</html>
