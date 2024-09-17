<?php
require_once 'Connection.php';

if(isset($_POST["submit"])) {
    $productId = $_POST["productId"];
    $productName = $_POST["productName"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    $fileName = $_FILES["image"]["name"];
    $tmpName = $_FILES["image"]["tmp_name"];
    $fileError = $_FILES["image"]["error"];

    $targetPath = 'img/'. basename($fileName);

    if($fileError === UPLOAD_ERR_OK) {
        if(move_uploaded_file($tmpName, $targetPath)) {
            $sql = "INSERT INTO product (ProductID, name, price, CategoryID, image) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssiss", $productId, $productName, $price, $category, $targetPath);
            if($stmt->execute()) {
                echo '<script>alert("Product Added Successfully!!");
                window.location.href = "Admin.php";</script>';
                exit();
            } else {
                echo "Error inserting product into database: " . $stmt->error;
            }
        } else {
            echo "Error moving uploaded file to target directory";
        }
    } else {
        echo "Error uploading file: " . $fileError;
    }
}
?>