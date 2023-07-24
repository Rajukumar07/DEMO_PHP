<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>
</head>
<body>
    <h1>Add New Item</h1>
    <form action="add_item.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" required><br>

        <input type="submit" value="Add Item">
    </form>

    <h1>Inventory List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
        <?php
        include('view_inventory.php');
        ?>
    </table>
</body>
</html>
