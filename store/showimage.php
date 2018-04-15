<?php
   header("Content-type: image/jpeg");
   $prodid = $_GET['id'];
   $con = mysql_connect("localhost", "test", "test") or die('');
   mysql_select_db("store", $con);

   $query = "SELECT picture from products WHERE prodid = $prodid";
   $result = mysql_query($query);
   $row = mysql_fetch_array($result, MYSQL_ASSOC);
   $picture = $row['picture'];
   echo $picture;
?>