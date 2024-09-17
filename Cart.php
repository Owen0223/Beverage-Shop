<?php
    require_once 'Connection.php';
        
        $user=$_COOKIE['user'];
        $productId = $_POST['productId'];
        $size = $_POST['size'];
        $sugar = $_POST['sugar'];
        $ice = $_POST['ice'];
        $quantity = $_POST['quantity'];
        $user = $_COOKIE['user'];
    
        $sql = "INSERT INTO cart (ProductID, sizes, sugar, ice, quantity, uname) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssis", $productId, $size, $sugar, $ice, $quantity, $user);
        $stmt->execute();
    
        echo '<script>alert("Product Added Successfully!!");
        window.location.href = "Cartlist.php";</script>';
        exit();


?>