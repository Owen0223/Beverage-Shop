<?php
    require_once 'Connection.php';
    $user = $_COOKIE['user'];

    $sql = "SELECT MAX(RecordID) AS maxRecordID FROM record";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $nextRecordID = $row['maxRecordID'] + 1;

    $sql = "INSERT INTO record (RecordID, ProductID, sizes, sugar, ice, quantity, uname) SELECT ?, ProductID, sizes, sugar, ice, quantity, uname FROM cart WHERE uname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $nextRecordID ,$user);
    $stmt->execute();

    $sql = "DELETE FROM cart WHERE uname = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user);
    $stmt->execute();

    echo '<script>alert("Payment Done!! Thanks for having Bings Chllin!!");
    window.location.href = "Record.php";</script>';
    exit();

    mysqli_close($conn);
?>