<?php
// Ensure that the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $productName = $_POST['product_name'];
    $quantity = (int)$_POST['quantity'];
    $price = (float)$_POST['price'];

    // Validate data (add further validation as needed)
    if (empty($productName) || $quantity <= 0 || $price <= 0) {
        echo "Invalid data. Please fill all the fields with valid values.";
        exit;
    }

    // Create an InventoryItem instance and add it to the database
    require_once('InventoryItem.php'); // Include the InventoryItem class here
    $item = new InventoryItem($productName, $quantity, $price);
    $result = $item->addItem();

    if ($result) {
        echo "Item added successfully!";
    } else {
        echo "Failed to add the item.";
    }
}
?>
