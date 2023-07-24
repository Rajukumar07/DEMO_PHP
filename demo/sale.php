<!DOCTYPE html>
<html>
<head>
    <title>Sale Module</title>
</head>
<body>
    <h1>Sales List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Sale Date</th>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Quantity</th>
        </tr>
        <?php
        require_once('Sale.php'); // Include the Sale class here
        require_once('InventoryItem.php'); // Include the InventoryItem class here
        $allSales = Sale::getAllSales();
        foreach ($allSales as $sale) {
            $item = InventoryItem::getItemById($sale->getItemId());
            echo "<tr>";
            echo "<td>" . $sale->getId() . "</td>";
            echo "<td>" . $sale->getSaleDate() . "</td>";
            echo "<td>" . $item->getId() . "</td>";
            echo "<td>" . $item->getProductName() . "</td>";
            echo "<td>" . $sale->getQuantity() . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Add New Sale</h1>
    <form action="add_sale.php" method="post">
        <label for="sale_date">Sale Date:</label>
        <input type="date" id="sale_date" name="sale_date" required><br>

        <label for="item_id">Item ID:</label>
        <input type="number" id="item_id" name="item_id" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <input type="submit" value="Add Sale">
    </form>
</body>
</html>
