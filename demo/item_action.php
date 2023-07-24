<?php
// ... (previous code)

// Example usage
$item1 = new InventoryItem("Product A", 10, 25.00);
$item1->addItem();

$item2 = new InventoryItem("Product B", 5, 15.00);
$item2->addItem();

$allItems = InventoryItem::getAllItems();
foreach ($allItems as $item) {
    echo "ID: " . $item->getId() . ", Name: " . $item->getProductName() . ", Quantity: " . $item->getQuantity() . ", Price: $" . $item->getPrice() . "<br>";
}
?>
