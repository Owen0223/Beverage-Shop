<?php
        require_once 'Connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <?php
        require_once 'header.php';
        require_once 'style.html';
    ?>
    <script>
        function toggle() {
            var payment = document.querySelector(".payment");

            payment.style.display = "block";
        }
    </script>
</head>
<body>
    <div id="cart" class="cart">
        <h1>Cart List</h1>
        <table id="cart-list">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Customizations</th>
                    <th>Price per unit</th>
                    <th>Quantity</th>
                    <th>Cancel Product</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user = $_COOKIE['user'];
                $finalprice = 0;
                $no = 1;

                $sql = "SELECT * FROM cart INNER JOIN product ON cart.ProductID = product.ProductID WHERE cart.uname = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $result = $stmt->get_result();

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $customizations = "Size: {$row['sizes']}<br/> Sugar Level: {$row['sugar']}<br/> Ice Level: {$row['ice']}";
                        
                        if($row['sizes'] = "Large(+RM1)"){
                            $addon = 1;
                        }else{
                            $addon = 0;
                        }

                        $priceunit = $row['price'] + $addon;
                        $totalprice = $priceunit * $row['quantity'];
                        $finalprice += $totalprice;

                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td><img src='{$row['image']}' alt='{$row['name']}' width='100' height='100'></td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$customizations}</td>";
                        echo "<td>RM" . number_format($priceunit, 2) . "</td>";
                        echo "<td>{$row['quantity']}</td>";
                        echo "<td>";
                        ?>
                        <form action = "deleted.php" method="POST">
                            <input type="hidden" name="cartId" value="<?php echo $row['CartID']; ?>">
                            <button type="submit">Cancel</button>
                        </form>
                        <?php
                        echo "</td>";
                        echo "<td>RM" . number_format($totalprice, 2) . "</td>";
                        echo "</tr>";

                        $no++;
                    }
                    echo "<tr>";
                    echo "<td colspan='7' style='text-align: right;'>Total</td>";
                    echo "<td>RM". number_format($finalprice, 2) . "</td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='8'>No items in the cart.</td></tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table><br/><br/>
        <button onclick="toggle()" style="width: 50px; height: 30px;">pay</button><br/>
    </div>
    <div id="payment" class="payment" style="display: none;">
            <hr/>
                <h2>Payment</h2>
            <?php
                echo "<h3>Payment Details</h3>";
                echo "Total Purchase Cost: RM" .number_format($finalprice, 2)."<br/><br/>";
                echo "Company address: 111, Jalan Indah 1/24, Taman Bukit Indah, 81200 Johor Bahru, Johor<br/><br/>";
                echo "Choose a pick-up method<br/><br/>";
                ?>
                <form action="checkout.php" method="POST">
                <input type="radio" id="delivery" name="pick-up-method" value="delivery">
                <label for="delivery">Delivery</label>&nbsp;&nbsp;
                <input type="radio" id="self-pickup" name="pick-up-method" value="self-pickup">
                <label for="self-pickup">Self-Pickup</label><br><br>
                <label for="pay">Payment Method: </label>
                <select name="pay" id="pay">
                <?php
                $pay = array("E-wallet", "Debit Card", "Credit Card");

                foreach ($pay as $payment) {
                    echo "<option value=\"$payment\">$payment</option>";
                }
                ?>
                </select><br/><br/>
                <label for="payid">Payment ID: </label>
                <input type="text" id="payid" name="payid">&nbsp;&nbsp;
                <label for="pin">PIN: </label>
                <input type="text" id="pin" name="pin"><br><br>
                <label for="fname">First Name: </label>
                <input type="text" id="fname" name="fname">&nbsp;&nbsp;
                <label for="lname">Last Name: </label>
                <input type="text" id="lname" name="lname"><br><br>
                <button>Checkout</button>
                </form>
    </div>
</body>
</html>
