<?php
// Fetch and display all items from the database
require_once('InventoryItem.php'); // Include the InventoryItem class here
$allItems = InventoryItem::getAllItems();
foreach ($allItems as $item) {
    echo "<tr>";
    echo "<td>" . $item->getId() . "</td>";
    echo "<td>" . $item->getProductName() . "</td>";
    echo "<td>" . $item->getQuantity() . "</td>";
    echo "<td>$" . $item->getPrice() . "</td>";
    echo "</tr>";
}
?>
<!-- or  -->
<?php
// Fetch and display all items from the database
require_once('InventoryItem.php'); // Include the InventoryItem class here
$allItems = InventoryItem::getAllItems();
foreach ($allItems as $item) {
    echo "<tr>";
    echo "<td>" . $item->getId() . "</td>";
    echo "<td>" . $item->getProductName() . "</td>";
    echo "<td>" . $item->getQuantity() . "</td>";
    echo "<td>$" . $item->getPrice() . "</td>";
    echo "<td><a href='edit_item.php?id=" . $item->getId() . "'>Edit</a></td>";
    echo "<td><a href='delete_item.php?id=" . $item->getId() . "'>Delete</a></td>";
    echo "</tr>";
}
?>
<!-- with AJAx call -->
<!DOCTYPE html>
<html>
<head>
    <title>Inventory System</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- ... (previous code) -->

    <h1>Inventory List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php
        require_once('InventoryItem.php'); // Include the InventoryItem class here
        $allItems = InventoryItem::getAllItems();
        foreach ($allItems as $item) {
            echo "<tr>";
            echo "<td>" . $item->getId() . "</td>";
            echo "<td>" . $item->getProductName() . "</td>";
            echo "<td>" . $item->getQuantity() . "</td>";
            echo "<td>$" . $item->getPrice() . "</td>";
            echo "<td>";
            echo "<button class='edit-button' data-id='" . $item->getId() . "'>Edit</button>";
            echo "<button class='delete-button' data-id='" . $item->getId() . "'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <script>
        $(document).ready(function() {
            // Delete item on button click
            $('.delete-button').on('click', function() {
                const itemId = $(this).data('id');
                if (confirm('Are you sure you want to delete this item?')) {
                    $.ajax({
                        url: 'delete_item.php',
                        method: 'POST',
                        data: { id: itemId },
                        success: function(response) {
                            alert(response);
                            location.reload(); // Refresh the page to reflect changes
                        },
                        error: function() {
                            alert('Failed to delete item.');
                        }
                    });
                }
            });

            // Other AJAX calls for add, update can be similarly implemented here
        });
    </script>
</body>
</html>


