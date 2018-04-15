<?php
   $delete = $_POST['button'];
   if ($delete == "Delete Product")
   {
      $prodid = $_POST['prodid'];
      $query = "DELETE from products WHERE prodid = $prodid";
      $result = mysql_query($query);
      if ($result)
      {
         echo "<h2>Product: $prodid deleted</h2>\n";
         exit;
      } else
      {
         echo "<h2>Problem deleting $prodid</h2>\n";
         exit;
      }
   } else
   {
      $prodid = $_POST['prodid'];
      $catid = $_POST['catid'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $quantity = $_POST['quantity'];

      if (get_magic_quotes_gpc())
      {
         $description = stripslashes($description);
      }
      $description = mysql_real_escape_string($description);

      if (isset($_POST['onsale']))
         $onsale = 1;
      else
         $onsale = 0;

      $PictName = $_FILES['picture']['name'];

      if ($PictName)
      {
         $thumbnail = getThumb($_FILES['picture']);
         $thumbnail = mysql_real_escape_string($thumbnail);
         $query = "UPDATE products SET catid='$catid', description = '$description', " .
                 "price = $price, quantity = $quantity, onsale = $onsale, picture = '$thumbnail' " .
                 "WHERE prodid = $prodid";
      }
      else
      {
         $query = "UPDATE products SET catid='$catid', description = '$description', " .
                 "price = $price, quantity = $quantity, onsale = $onsale " .
                 "WHERE prodid = $prodid";
      }

      $result = mysql_query($query) or die(mysql_error());
      if ($result)
      {
         echo "<h2>Product information changed.</h2>\n";
      }
      else
      {
         echo "<h2>Sorry, I could not change the product information.</h2>\n";
      }
   }
?>