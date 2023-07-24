<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $itemId = (int)$_GET['id'];

    require_once('InventoryItem.php'); // Include the InventoryItem class here
    $item = InventoryItem::getItemById($itemId);

    if (!$item) {
        echo "Item not found.";
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $itemId = (int)$_POST['id'];
    if ($item->deleteItem()) {
        echo "Item deleted successfully!";
    } else {
        echo "Failed to delete the item.";
    }
}


?>
    // 
    <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $itemId = (int)$_POST['id'];

    require_once('InventoryItem.php'); // Include the InventoryItem class here
    $item = InventoryItem::getItemById($itemId);

    if (!$item) {
        echo "Item not found.";
        exit;
    }

    // Delete the item
    if ($item->deleteItem()) {
        echo "Item deleted successfully!";
    } else {
        echo "Failed to delete the item.";
    }
}
?>
