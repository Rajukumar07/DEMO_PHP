<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ... (similar to previous POST handling in add_item.php)

    // Create a Supplier instance and add it to the database
    require_once('Supplier.php'); // Include the Supplier class here
    $supplier = new Supplier($supplierName, $contactPerson, $email, $phone);
    $result = $supplier->addSupplier();

    if ($result) {
        echo "Supplier added successfully!";
    } else {
        echo "Failed to add the supplier.";
    }
}
?>
