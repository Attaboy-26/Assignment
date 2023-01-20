<?php

echo "<link rel='stylesheet' type='text/css' href='pstyle.css'>";

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$uname = $_POST['uname'];
$pwrd = $_POST['pwrd'];

if(!empty($fname) || !empty($lname) || !empty($uname) || !empty($pwrd)){
     $host = "localhost";
     $dbusername = "root";
     $dbpassword = "";
     $dbname = "assignment";

     $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
     
     if(mysqli_connect_error()){
          die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
     }
     else{
          $SELECT = "SELECT uname FROM users Where uname = ? Limit 1";
          $INSERT = "INSERT Into users (fname, lname, uname, pwrd)values(?,?,?,?)";

          $stmt = $conn->prepare($SELECT);
          $stmt->bind_param("s", $uname);
          $stmt->execute();
          $stmt->bind_result($uname);
          $stmt->store_result();
          $rnum = $stmt->num_rows;

          if($rnum==0) {
               $stmt->close();
               $stmt = $conn->prepare($INSERT);
               $stmt->bind_param("ssss", $fname, $lname, $uname, $pwrd);
               $stmt->execute();
               $lastid = $conn->insert_id;
               echo '<div>';
               echo "<b>WOOHOO!</b><br><br>You have registered successfully. Your user ID is: \n". $lastid ;
               echo '</div>';
               
          }
          else{
               echo '<div>';
               echo "<b>OOPS!</b><br><br>Someone already registered using this username. Try a different one!";
               echo '</div>';
          }

          $stmt->close();
          $conn->close();
     }
}
else{
     echo "All fields are required!";
     die();
}
?>