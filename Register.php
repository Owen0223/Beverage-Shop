<?php
      require_once 'Connection.php';
      $username = $_POST["Rusername"];
      $password = $_POST["Rpassword"];
      $confirm = $_POST["RCpassword"];
      $phone = $_POST["phone"];
      $address = $_POST["address"];
      $isadmin = 0;
      
      if($confirm === $password){
          $sql = "INSERT INTO user (uname, pword, pnum, adress, isadmin) VALUES (?,?,?,?,?);";
          $stmt = $conn->prepare($sql);

          $stmt->bind_param("ssssi", $username, $password, $phone, $address, $isadmin);

          $stmt->execute();

          $conn->close();
          $stmt->close();

          echo '<script>alert("Chllin Account Created Successfully!!");
          window.location.href = "LoginCreate.php";</script>';

          die();
          }
          else{
            echo '<script>alert("Passwords do not match. Please try again.");
            window.location.href = "LoginCreate.php";</script>';
          }
      ?>
