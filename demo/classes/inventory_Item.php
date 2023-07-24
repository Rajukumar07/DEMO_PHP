<!-- CREATE TABLE inventory (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_name VARCHAR(255),
    quantity INT,
    price DECIMAL(10, 2)
);
 -->


<?php
class InventoryItem
{
    private $id;
    private $productName;
    private $quantity;
    private $price;

    public function __construct($productName, $quantity, $price)
    {
        $this->productName = $productName;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    // Add a new item to the database
    public function addItem()
    {
        global $conn;
        $query = "INSERT INTO inventory (product_name, quantity, price) VALUES (?, ?, ?)";
        $params = array($this->productName, $this->quantity, $this->price);
        $stmt = sqlsrv_query($conn, $query, $params);

        return $stmt !== false;
    }

    // Update an existing item in the database
    public function updateItem()
    {
        global $conn;
        $query = "UPDATE inventory SET product_name = ?, quantity = ?, price = ? WHERE id = ?";
        $params = array($this->productName, $this->quantity, $this->price, $this->id);
        $stmt = sqlsrv_query($conn, $query, $params);

        return $stmt !== false;
    }

    // Delete an item from the database
    public function deleteItem()
    {
        global $conn;
        $query = "DELETE FROM inventory WHERE id = ?";
        $params = array($this->id);
        $stmt = sqlsrv_query($conn, $query, $params);

        return $stmt !== false;
    }

    // Retrieve all items from the database
    public static function getAllItems()
    {
        global $conn;
        $query = "SELECT * FROM inventory";
        $stmt = sqlsrv_query($conn, $query);

        $items = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $item = new InventoryItem($row['product_name'], $row['quantity'], $row['price']);
            $item->id = $row['id'];
            $items[] = $item;
        }

        return $items;
    }

    // Retrieve a specific item from the database by ID
    public static function getItemById($itemId)
    {
        global $conn;
        $query = "SELECT * FROM inventory WHERE id = ?";
        $params = array($itemId);
        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt !== false && sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $item = new InventoryItem($row['product_name'], $row['quantity'], $row['price']);
            $item->id = $row['id'];

            return $item;
        }

        return null;
    }




    // ... (previous properties and methods)

    private $supplierId; // New property to store supplier ID

    public function __construct($productName, $quantity, $price, $supplierId)
    {
        $this->productName = $productName;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->supplierId = $supplierId;
    }

    public function getSupplierId()
    {
        return $this->supplierId;
    }

    // ... (previous methods)

    // Retrieve the supplier information for this item
    public function getSupplier()
    {
        if ($this->supplierId) {
            global $conn;
            $query = "SELECT * FROM suppliers WHERE id = ?";
            $params = array($this->supplierId);
            $stmt = sqlsrv_query($conn, $query, $params);

            if ($stmt !== false && sqlsrv_has_rows($stmt)) {
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                return new Supplier($row['supplier_name'], $row['contact_person'], $row['email'], $row['phone']);
            }
        }

        return null;
    }



    public function getPurchases()
    {
        global $conn;
        $query = "SELECT * FROM purchases WHERE item_id = ?";
        $params = array($this->id);
        $stmt = sqlsrv_query($conn, $query, $params);

        $purchases = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $purchase = new Purchase($row['purchase_date'], $row['item_id'], $row['quantity']);
            $purchase->id = $row['id'];
            $purchases[] = $purchase;
        }

        return $purchases;
    }

     // Retrieve all sales related to this item
     public function getSales()
     {
         global $conn;
         $query = "SELECT * FROM sales WHERE item_id = ?";
         $params = array($this->id);
         $stmt = sqlsrv_query($conn, $query, $params);
 
         $sales = array();
         while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
             $sale = new Sale($row['sale_date'], $row['item_id'], $row['quantity']);
             $sale->id = $row['id'];
             $sales[] = $sale;
         }
 
         return $sales;
     }
}
?>





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


<!-- or  -->

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (previous code)

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
