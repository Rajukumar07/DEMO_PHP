<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (similar to previous POST handling in add_item.php)

    // Create a Sale instance and add it to the database
    require_once('Sale.php'); // Include the Sale class here
    $sale = new Sale($saleDate, $itemId, $quantity);
    $result = $sale->addSale();

    if ($result) {
        echo "Sale added successfully!";
    } else {
        echo "Failed to add the sale.";
    }
}
?>
