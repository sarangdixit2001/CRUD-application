<?php
   $server = "localhost";
   $user = "root";
   $password = "";
   $db = "crud app";

   $con = mysqli_connect($server,$user,$password,$db);

  if($con){
?>
   <script>
    
   </script>

<?php
  }else{
   ?>
   <script>
    alert("Connection Broke ");
   </script>
   <?php
  }
?>