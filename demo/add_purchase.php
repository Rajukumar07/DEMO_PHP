<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (similar to previous POST handling in add_item.php)

    // Create a Purchase instance and add it to the database
    require_once('Purchase.php'); // Include the Purchase class here
    $purchase = new Purchase($purchaseDate, $itemId, $quantity);
    $result = $purchase->addPurchase();

    if ($result) {
        echo "Purchase added successfully!";
    } else {
        echo "Failed to add the purchase.";
    }
}
?>
