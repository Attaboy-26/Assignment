<?php

echo "<link rel='stylesheet' type='text/css' href='pstyle.css'>";

$userid = $_POST['userid'];

if(!empty($userid)){
     $host = "localhost";
     $dbusername = "root";
     $dbpassword = "";
     $dbname = "assignment";

     $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
     
     if(mysqli_connect_error()){
          die('Connect Error(' . mysqli_connect_errno() . ')' . mysqli_connect_error());
     }

     else{

          $sql = "SELECT * FROM users WHERE userid = $userid";
          $result = $conn->query($sql);
          $row = $result -> fetch_array(MYSQLI_ASSOC);
          if(mysqli_num_rows($result)==0){
               printf("User doesn't exist!");
          }
          elseif (mysqli_num_rows($result)==1) {

               if(!$row){
                    printf("User no longer exists!");
               }

               else {
                    echo '<div>';
                    printf('<b>USER DETAILS</b><br><br>Firstname: %s <br> Lastname: %s <br> Username: %s <br> User ID: %d', $row["fname"], $row["lname"], $row["uname"], $row["userid"]);
                    echo '</div>';
                    mysqli_free_result($result);
               }
          }
          mysqli_close($conn);
     }
}
else{
     echo "Enter the User ID!";
     die();
}

?>