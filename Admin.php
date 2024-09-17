<!DOCTYPE html>
<html>
  <head>
    <title>Admin</title>
    <?php
        require_once 'Connection.php';
        require_once 'header.php';
        require_once 'style.html';
    ?>
  </head>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const productId = button.parentElement.parentElement.firstElementChild.textContent;
                deleteStockItem(productId);
            });
        });
    });

    function deleteStockItem(product_id) {
        if (confirm("Are you sure you want to delete this item?")) {
            fetch('delete_product.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `product_id=${product_id}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    console.error('Error deleting item:', data.error);
                }
            })
            .catch(error => {
                console.error('HTTP error:', error);
            });
        }
    }
</script>

  <body>
    <div class="form-container">
            <div class="form-box">
                <h3>Add a New Product</h3>
                <form action="adminconnection.php" method="POST" enctype="multipart/form-data">
                <input type="text" id="productId" name="productId" placeholder="PRODUCT ID"><br>
                <input type="text" id="productName" name="productName" placeholder="PRODUCT NAME"><br>
                <input type="text" id="price" name="price" placeholder="PRICE"><br>
                <input type="text" id="category" name="category" placeholder="CATEGORY"><br>
                <input type="file" id="image" name="image"><br>
                <input type="submit" name="submit" value="ADD">
                </form>
            </div>
    </div>
  </body>
</html>