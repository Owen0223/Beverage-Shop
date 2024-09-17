<?php
          include_once 'Connection.php';
          $username = $_POST["username"];
          $password = $_POST["password"];
          $sql = "SELECT * FROM user WHERE uname = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $username);
          $stmt->execute();
          $result = $stmt->get_result();
          
            if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['pword'] === $password) {
              echo '<script>alert("Login Successfully!!");</script>';
              setcookie("user", $user['uname'], time() + (86400 * 30)); 
              if($user['isadmin'] == 0){
              echo '<script>window.location.href = "Home.php";</script>';
              }else{
              echo '<script>window.location.href = "Admin.php";</script>';
              }
            } else {
              echo '<script>alert("Invalid Password, Please Try Again!");
              window.location.href = "LoginCreate.php";</script>';
            }
          } else {
            echo '<script>alert("User not found, Please Try Again!");
            window.location.href = "LoginCreate.php";</script>';
          }

          $stmt->close();
      ?>
