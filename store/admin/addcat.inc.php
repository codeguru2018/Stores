<?php
   $catname = $_POST['catname'];

   if (get_magic_quotes_gpc())
   {
      $catname = stripslashes($catname);
   }
   $catnameval = mysql_real_escape_string($catname);

   $query="INSERT INTO categories (name) VALUES ('$catnameval')";
   $result = mysql_query($query);

   if ($result)
      echo "<h2>New category '$catname' added</h2>\n";
   else
      echo "<h2>Sorry, unable to add new category</h2>\n";
?>   