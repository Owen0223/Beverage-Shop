<?php
    include('Connection.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <style>
        body {
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          height: 100vh;
          margin: 0;
          font-family: Arial, sans-serif;
          background-color: #fec27c;
;
        }
  
        h3 {
          margin-bottom: 0;
        }
  
        h4 {
          margin-top: 0;
        }
  
        form {
          display: flex;
          flex-direction: column;
          align-items: center;
          margin-top: 20px;
        }
  
        label {
          margin-top: 10px;
        }
  
        input[type="text"],
        input[type="password"],
        input[type="tel"],
        textarea {
          width: 300px;
          padding: 5px;
          margin-bottom: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
        }
  
        textarea {
          height: 100px;
        }
  
        button,
        input[type="submit"] {
          padding: 5px 20px;
          margin-top: 10px;
          border: none;
          border-radius: 5px;
          background-color: white;
          color: #57200a;
          cursor: pointer;
        }
  
        button:hover,
        input[type="submit"]:hover {
          background-color: #ddd;
        }
  
        #registerForm {
          display: none;
        }
      </style>
      <script>
        function toggleRegisterForm() {
          var registerForm = document.getElementById("registerForm");
            registerForm.style.display = "block";
            Login.style.display = "none";
        }

        function toggleCancelForm(){
            var createForm = document.getElementById("registerForm");
            registerForm.style.display = "none";
            Login.style.display = "block";
        }
      </script>
      
  </head>
  <body>
    <div id="Login">
    <h3>Welcome to Bing's Chllin</h3>
    <h4>Please enter your username and password</h4>
    <form action="Login.php" method="post">
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username" value="<?php if (isset($_COOKIE["user"])? $_COOKIE['user']:''){echo $_COOKIE["user"];}?>" required><br/><br/>
      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password" required>
      <input type="submit" value="Login"><br/>
    <br/>Don't have a Chillin account?<br/>
    <button onclick="toggleRegisterForm()">Register</button><br/>
    </form>
    </div>
    <div id="registerForm">
      <h4>Create your Chillin account</h4>
      <form action="Register.php" method="post">
        <label for="Rusername">Username:</label><br>
        <input type="text" id="Rusername" name="Rusername" required><br>
        <label for="Rpassword">Password:</label><br>
        <input type="password" id="Rpassword" name="Rpassword" required><br>
        <label for="RCpassword">Confirm Password:</label><br>
        <input type="password" id="RCpassword" name="RCpassword" required><br>
        <label for="phone">Phone Number:</label><br>
        <input type="text" id="phone" name="phone" required><br>
        <label for="address">Billing Address:</label><br>
        <textarea id="address" name="address" required></textarea><br/>
        <button onclick="toggleCancelForm()">Cancel</button>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" value="Create">
      </form>
    </div>
  </body>
</html>