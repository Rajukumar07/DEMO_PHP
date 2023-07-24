<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $itemId = (int)$_GET['id'];

    require_once('InventoryItem.php'); // Include the InventoryItem class here
    $item = InventoryItem::getItemById($itemId);

    if (!$item) {
        echo "Item not found.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Inventory Item</title>
</head>
<body>
    <h1>Edit Item</h1>
    <form action="update_item.php" method="post">
        <input type="hidden" name="id" value="<?php echo $item->getId(); ?>">

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $item->getProductName(); ?>" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $item->getQuantity(); ?>" required><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" value="<?php echo $item->getPrice(); ?>" required><br>

        <input type="submit" value="Update Item">
    </form>
</body>
</html>
