<!-- CREATE TABLE suppliers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    supplier_name VARCHAR(255),
    contact_person VARCHAR(255),
    email VARCHAR(100),
    phone VARCHAR(20)
);
 -->

 <!--  -->

 <?php
class Supplier
{
    private $id;
    private $supplierName;
    private $contactPerson;
    private $email;
    private $phone;

    public function __construct($supplierName, $contactPerson, $email, $phone)
    {
        $this->supplierName = $supplierName;
        $this->contactPerson = $contactPerson;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getSupplierName()
    {
        return $this->supplierName;
    }

    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    // Add a new supplier to the database
    public function addSupplier()
    {
        global $conn;
        $query = "INSERT INTO suppliers (supplier_name, contact_person, email, phone) VALUES (?, ?, ?, ?)";
        $params = array($this->supplierName, $this->contactPerson, $this->email, $this->phone);
        $stmt = sqlsrv_query($conn, $query, $params);

        return $stmt !== false;
    }

    // Retrieve all suppliers from the database
    public static function getAllSuppliers()
    {
        global $conn;
        $query = "SELECT * FROM suppliers";
        $stmt = sqlsrv_query($conn, $query);

        $suppliers = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $supplier = new Supplier($row['supplier_name'], $row['contact_person'], $row['email'], $row['phone']);
            $supplier->id = $row['id'];
            $suppliers[] = $supplier;
        }

        return $suppliers;
    }
}
?>
