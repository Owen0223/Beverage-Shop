<?php
  require_once 'Connection.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <?php
      require_once 'style.html';
    ?>
    <script>
    function showProducts(categoryId) {
      var container = document.getElementById("product-container");
      container.style.display = "none";
      fetchProducts(categoryId, container);
    }

    function fetchProducts(categoryId, container) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          container.innerHTML = xhr.responseText;
          container.style.display = "block";
        }
      };
      xhr.open("GET", "product.php?categoryId=" + categoryId, true);
      xhr.send();
    }
  </script>
  <?php
    require_once 'header.php';
  ?>
    </head>
  <body>
    <h3>What you want to drink today?</h3>
        <div id="category">
        <button onclick="showProducts('c1')">Milk Tea</button>
        <button onclick="showProducts('c2')">Juice</button>
        <button onclick="showProducts('c3')">Sparkling</button>
        <button onclick="showProducts('c4')">Coffee</button>
        <button onclick="showProducts('c5')">Fruit Tea</button><br/>
        </div>
        <?php
          require_once 'product.php';
        ?>
  </body>
</html>

