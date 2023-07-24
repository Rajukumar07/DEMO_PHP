<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (similar to previous POST handling in add_item.php)

    // Create a Customer instance and add it to the database
    require_once('Customer.php'); // Include the Customer class here
    $customer = new Customer($customerName, $contactPerson, $email, $phone);
    $result = $customer->addCustomer();

    if ($result) {
        echo "Customer added successfully!";
    } else {
        echo "Failed to add the customer.";
    }
}
?>
