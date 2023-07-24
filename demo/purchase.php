<!DOCTYPE html>
<html>
<head>
    <title>Purchase Module</title>
</head>
<body>
    <h1>Purchases List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Purchase Date</th>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Quantity</th>
        </tr>
        <?php
        require_once('Purchase.php'); // Include the Purchase class here
        require_once('InventoryItem.php'); // Include the InventoryItem class here
        $allPurchases = Purchase::getAllPurchases();
        foreach ($allPurchases as $purchase) {
            $item = InventoryItem::getItemById($purchase->getItemId());
            echo "<tr>";
            echo "<td>" . $purchase->getId() . "</td>";
            echo "<td>" . $purchase->getPurchaseDate() . "</td>";
            echo "<td>" . $item->getId() . "</td>";
            echo "<td>" . $item->getProductName() . "</td>";
            echo "<td>" . $purchase->getQuantity() . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Add New Purchase</h1>
    <form action="add_purchase.php" method="post">
        <label for="purchase_date">Purchase Date:</label>
        <input type="date" id="purchase_date" name="purchase_date" required><br>

        <label for="item_id">Item ID:</label>
        <input type="number" id="item_id" name="item_id" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <input type="submit" value="Add Purchase">
    </form>
</body>
</html>
