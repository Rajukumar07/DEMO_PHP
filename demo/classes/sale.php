<!-- CREATE TABLE sales (
    id INT PRIMARY KEY AUTO_INCREMENT,
    sale_date DATE,
    item_id INT,
    quantity INT,
    FOREIGN KEY (item_id) REFERENCES inventory(id)
);
 -->

<?php
class Sale
{
    private $id;
    private $saleDate;
    private $itemId;
    private $quantity;
    private $customerId; // New property to store customer ID

    public function __construct($saleDate, $itemId, $quantity, $customerId)
    {
        $this->saleDate = $saleDate;
        $this->itemId = $itemId;
        $this->quantity = $quantity;
        $this->customerId = $customerId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSaleDate()
    {
        return $this->saleDate;
    }

    public function getItemId()
    {
        return $this->itemId;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    // Retrieve the customer information for this sale
    public function getCustomer()
    {
        if ($this->customerId) {
            global $conn;
            $query = "SELECT * FROM customers WHERE id = ?";
            $params = array($this->customerId);
            $stmt = sqlsrv_query($conn, $query, $params);

            if ($stmt !== false && sqlsrv_has_rows($stmt)) {
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
                return new Customer($row['customer_name'], $row['contact_person'], $row['email'], $row['phone']);
            }
        }

        return null;
    }

    // Add a new sale to the database
    public function addSale()
    {
        global $conn;
        $query = "INSERT INTO sales (sale_date, item_id, quantity, customer_id) VALUES (?, ?, ?, ?)";
        $params = array($this->saleDate, $this->itemId, $this->quantity, $this->customerId);
        $stmt = sqlsrv_query($conn, $query, $params);

        return $stmt !== false;
    }

    // Retrieve all sales from the database
    public static function getAllSales()
    {
        global $conn;
        $query = "SELECT * FROM sales";
        $stmt = sqlsrv_query($conn, $query);

        $sales = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $sale = new Sale($row['sale_date'], $row['item_id'], $row['quantity'], $row['customer_id']);
            $sale->id = $row['id'];
            $sales[] = $sale;
        }

        return $sales;
    }
}
?>
