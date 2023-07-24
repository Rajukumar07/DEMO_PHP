<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $customerId = (int)$_POST['id'];

    require_once('./classes/Customer.php'); // Include the Customer class here
    $customer = Customer::getCustomerById($customerId);

    if (!$customer) {
        echo "Customer not found.";
        exit;
    }

    // Delete the customer
    if ($customer->deleteCustomer()) {
        echo "Customer deleted successfully!";
    } else {
        echo "Failed to delete the customer.";
    }
}
?>
