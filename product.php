<?php
  require_once 'Connection.php';
?>

<html>
    <style>
      .products {
      border: 1px solid #ddd;
      display: flex;
      margin: 20px auto;
      padding: 30px;
      text-align: center;
      flex-wrap: wrap;
      justify-content: space-evenly;
    }
      #product-container {
        flex-wrap: wrap;
        padding: 20px;
      }
    </style>

<script>
function preventNegative(event) {
    const input = event.target;
    if (input.value < 1) {
        input.value = 1;
    }
}
</script>

<div id="product-container" class="product-container">
    <h2>Products</h2>
    <?php
          if(isset($_GET['categoryId'])){
          $categoryId = $_GET['categoryId'];

          $sql = "SELECT * FROM product WHERE CategoryID = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $categoryId);
          $stmt->execute();
          $result = $stmt->get_result();
          ?>
        <div class="products">
        <?php
        if($result->num_rows > 0){
          while($fetch_product = mysqli_fetch_assoc($result)){
            ?>
            <div style="margin-left: 100px; margin: 20px auto; padding: 30px;">
            <?php
            echo "<br/><img src='" . $fetch_product['image'] . "' alt='" . $fetch_product['name'] . "' style='width: 200px; height: 200px;'>";
            echo "<h3>" . $fetch_product['name'] . "</h3>";
            echo "<p>RM" .number_format($fetch_product['price'],2). "</p>";
            ?>
            <form action="Cart.php" method="POST">
            <label for="size">Size:</label>
        <select name="size" id="size">
            <?php
            $sizeselect = array("Medium", "Large(+RM1)");

            foreach ($sizeselect as $size) {
                echo "<option value=\"$size\">$size</option>";
            }
            ?>
        </select></br></br>
        <label for="sugar">Sugar Level:</label>
        <select name="sugar" id="sugar">
            <?php
            $sugarlevel = array("Normal", "Extra", "Less", "None");

            foreach ($sugarlevel as $sugar) {
                echo "<option value=\"$sugar\">$sugar</option>";
            }
            ?>
        </select></br></br>
        <label for="ice">Ice Level:</label>
        <select name="ice" id="ice">
            <?php
            $icelevel = array("Normal", "Extra", "Less", "None");

            foreach ($icelevel as $ice) {
                echo "<option value=\"$ice\">$ice</option>";
            }
            ?>
        </select></br></br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" style="width: 30px;" oninput="preventNegative(event)"></br></br>
        <input type="hidden" name="productId" value="<?php echo $fetch_product['ProductID']; ?>">
              <button type="submit">Buy</button>
            </form>
            </div>
            <?php
          }
            ?>
          
        </div>
            <?php
          }
        }else{
          $product = mysqli_query($conn, "SELECT * FROM product");
          ?>
        <div class="products">
        <?php
        if(mysqli_num_rows($product) > 0){
          while($fetch_product = mysqli_fetch_assoc($product)){
            ?>
            <div style="margin-left: 100px;">
            <?php
            echo "<br/><img src='" . $fetch_product['image'] . "' alt='" . $fetch_product['name'] . "' style='width: 200px; height: 200px;'>";
            echo "<h3>" . $fetch_product['name'] . "</h3>";
            echo "<p>RM" .number_format($fetch_product['price'],2). "</p>";
            ?>
            <form action="Cart.php" method="POST">
            <label for="size">Size:</label>
        <select name="size" id="size">
            <?php
            $sizeselect = array("Medium", "Large(+RM1)");

            foreach ($sizeselect as $size) {
                echo "<option value=\"$size\">$size</option>";
            }
            ?>
        </select></br></br>
        <label for="sugar">Sugar Level:</label>
        <select name="sugar" id="sugar">
            <?php
            $sugarlevel = array("Normal", "Extra", "Less", "None");

            foreach ($sugarlevel as $sugar) {
                echo "<option value=\"$sugar\">$sugar</option>";
            }
            ?>
        </select></br></br>
        <label for="ice">Ice Level:</label>
        <select name="ice" id="ice">
            <?php
            $icelevel = array("Normal", "Extra", "Less", "None");

            foreach ($icelevel as $ice) {
                echo "<option value=\"$ice\">$ice</option>";
            }
            ?>
        </select></br></br>
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" style="width: 30px;" oninput="preventNegative(event)"></br></br>
        <input type="hidden" name="productId" value="<?php echo $fetch_product['ProductID']; ?>">
            <button type="submit">Buy</button>
            </form>
          </div>
            <?php
          }
        }
      }
        ?>  
  </div>
    </div>
</html>