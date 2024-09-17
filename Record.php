<?php
        require_once 'Connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Record</title>
    <?php
        require_once 'header.php';
        require_once 'style.html';
    ?>
</head>
<body>

    <div id="record" class="record">
        <h1>Purchase Record</h1>
        <table id="record-list">
                <?php
                $user = $_COOKIE['user'];
                $currentid = null;

                $sql = "SELECT * FROM record INNER JOIN product ON record.ProductID = product.ProductID WHERE record.uname = ? ORDER BY record.RecordID";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['RecordID'] !== $currentid) {
                        if ($currentid !== null) {
                            echo "<tr><td>TOTAL:</td><td colspan='3'>RM" . number_format($total, 2) . "</td></tr>";
                            echo "</table>";
                            echo "</br><form action='reorder.php' method='post'>";
                            echo "<input type='hidden' name='current' value='" . $currentid . "'>";
                            echo "<input type='submit' class='button' name='Re-order' value='Re-Order'>";
                            echo "</form>";
                        }
                        echo "<table border='1'>";
                        echo "<tr><td>YOUR ORDERS:</td><td colspan='3'>";
                        $total = 0;
                    }
                    echo $row['name'] . " x " . $row['quantity'] . "<br>";
                    $total += ($row['price'] * $row['quantity']);
                    $currentid = $row['RecordID'];
                }
                echo "<tr><td>TOTAL:</td><td colspan='3'>RM" . number_format($total, 2) . "</td></tr>";
                echo "</table>";
                echo "</br><form action='reorder.php' method='post'>";
                echo "<input type='hidden' name='current' value='" . $currentid . "'>";
                echo "<input type='submit' class='button' name='Re-order' value='Re-Order'>";
                echo "</form><br/>";
                ?>
    </div>
</body>
</html>
