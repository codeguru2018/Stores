<?php
   echo "<h2><u>Finalizing Order</u></h2><br>\n";
   echo "Creating order.\n";
   $custid = $_SESSION['cust'];
   $date = date("Y-m-d G:i:s");
   $status = "pending";

   $result1 = @mysql_query("Set autocommit=0");
   $result2 = @mysql_query("set sql_mode = 'STRICT_ALL_TABLES'");
   $result3 = @mysql_query("START TRANSACTION");

   $query = "INSERT INTO orders (custid, date, status) VALUES " .
          " ($custid, '$date', '$status')";
   $result4 = @mysql_query($query);

   $query = "SELECT LAST_INSERT_ID() from orders";
   $result5 = @mysql_query($query);

   $row = mysql_fetch_array($result5);
   $orderid = $row[0];
  foreach($_SESSION['cart'] as $prodid => $quantity)
{
   $query = "SELECT price FROM products where prodid = $prodid";
   $result6i = @mysql_query($query);
   $row = mysql_fetch_array($result6i);
   $price = $row[0];

   $query = "INSERT into order_items VALUES ($orderid, $prodid, $quantity, $price)";
      $result6a = @mysql_query($query);

      $query = "UPDATE products set quantity = quantity - $quantity WHERE prodid = $prodid";
      $result6b = @mysql_query($query);

      if ($result6a && $result6b)
      {
         $result6 = true;
      } else
      {
         $result6 = false;
         break;
      }
   }

   if ($result1 && $result2 && $result3 && $result4 && $result5 && $result6)
   {
      $result = @mysql_query("COMMIT");
      if ($result)
      {
         echo "Your order has been placed.<br><br>\n";
         echo "<h2>Your order number is #$orderid.<br>\n";
         echo "<h2>Please save this number for future reference.<br>Thank you!</h2>\n";

         unset($_SESSION['cart']);
      } else
      {
         echo "<h2>Sorry, we are unable to create your order at this time.</h2>\n";
         echo "<h2>Please double check product availability.</h2>\n";
      }
   } else
   {
      $result = @mysql_query("ROLLBACK");
      echo "<h2>Sorry, we are unable to create your order at this time.</h2>\n";
   }
?>