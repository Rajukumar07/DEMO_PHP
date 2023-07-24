<!-- CREATE TABLE purchases (
    id INT PRIMARY KEY AUTO_INCREMENT,
    purchase_date DATE,
    item_id INT,
    quantity INT,
    FOREIGN KEY (item_id) REFERENCES inventory(id)
);
 -->

 <?php
class Purchase
{
    private $id;
    private $purchaseDate;
    private $itemId;
    private $quantity;

    public function __construct($purchaseDate, $itemId, $quantity)
    {
        $this->purchaseDate = $purchaseDate;
        $this->itemId = $itemId;
        $this->quantity = $quantity;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    public function getItemId()
    {
        return $this->itemId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    // Add a new purchase to the database
    public function addPurchase()
    {
        global $conn;
        $query = "INSERT INTO purchases (purchase_date, item_id, quantity) VALUES (?, ?, ?)";
        $params = array($this->purchaseDate, $this->itemId, $this->quantity);
        $stmt = sqlsrv_query($conn, $query, $params);

        return $stmt !== false;
    }

    // Retrieve all purchases from the database
    public static function getAllPurchases()
    {
        global $conn;
        $query = "SELECT * FROM purchases";
        $stmt = sqlsrv_query($conn, $query);

        $purchases = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $purchase = new Purchase($row['purchase_date'], $row['item_id'], $row['quantity']);
            $purchase->id = $row['id'];
            $purchases[] = $purchase;
        }

        return $purchases;
    }
}
?>
