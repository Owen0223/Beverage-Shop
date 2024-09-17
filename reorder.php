<?php
    require_once 'Connection.php';
    if(isset($_POST['current'])){
    $recordid = $_POST['current']; 

        $sql = "INSERT INTO cart (ProductID, sizes, sugar, ice, quantity, uname) SELECT ProductID, sizes, sugar, ice, quantity, uname FROM record WHERE RecordID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $recordid);
        $stmt->execute();
    
        $sql = "DELETE FROM record WHERE RecordID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $recordid);
        $stmt->execute();
    
        echo '<script>window.location.href = "Cartlist.php";</script>';
        exit();

        mysqli_close($conn);
    }


?>