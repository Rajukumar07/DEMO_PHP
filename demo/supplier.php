<!DOCTYPE html>
<html>
<head>
    <title>Supplier Module</title>
</head>
<body>
    <h1>Suppliers List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Supplier Name</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
        <?php
        require_once('Supplier.php'); // Include the Supplier class here
        $allSuppliers = Supplier::getAllSuppliers();
        foreach ($allSuppliers as $supplier) {
            echo "<tr>";
            echo "<td>" . $supplier->getId() . "</td>";
            echo "<td>" . $supplier->getSupplierName() . "</td>";
            echo "<td>" . $supplier->getContactPerson() . "</td>";
            echo "<td>" . $supplier->getEmail() . "</td>";
            echo "<td>" . $supplier->getPhone() . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Add New Supplier</h1>
    <form action="add_supplier.php" method="post">
        <label for="supplier_name">Supplier Name:</label>
        <input type="text" id="supplier_name" name="supplier_name" required><br>

        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required><br>

        <input type="submit" value="Add Supplier">
    </form>
</body>
</html>
