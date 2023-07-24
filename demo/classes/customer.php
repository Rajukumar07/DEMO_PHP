<!--CREATE TABLE customers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    customer_name VARCHAR(255),
    contact_person VARCHAR(255),
    email VARCHAR(100),
    phone VARCHAR(20)
);
  -->




<?php
class Customer
{
    private $id;
    private $customerName;
    private $contactPerson;
    private $email;
    private $phone;

    public function __construct($customerName, $contactPerson, $email, $phone)
    {
        $this->customerName = $customerName;
        $this->contactPerson = $contactPerson;
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCustomerName()
    {
        return $this->customerName;
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

    // Add a new customer to the database
    public function addCustomer()
    {
        global $conn;
        $query = "INSERT INTO customers (customer_name, contact_person, email, phone) VALUES (?, ?, ?, ?)";
        $params = array($this->customerName, $this->contactPerson, $this->email, $this->phone);
        $stmt = sqlsrv_query($conn, $query, $params);

        return $stmt !== false;
    }

    // Retrieve all customers from the database
    public static function getAllCustomers()
    {
        global $conn;
        $query = "SELECT * FROM customers";
        $stmt = sqlsrv_query($conn, $query);

        $customers = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $customer = new Customer($row['customer_name'], $row['contact_person'], $row['email'], $row['phone']);
            $customer->id = $row['id'];
            $customers[] = $customer;
        }

        return $customers;
    }

     // Retrieve  customers by id from the database
     public static function getCustomerById($custid)
     {
        global $conn;
        $query = "SELECT * FROM customer WHERE id = ?";
        $params = array($custid);
        $stmt = sqlsrv_query($conn, $query, $params);

        if ($stmt !== false && sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $customer = new Customer($row['customer_name'], $row['contact_person'], $row['email'], $row['phone']));
            $customer->id = $row['id'];

            return $customer;
        }

        return null;
     }
}
?>