<!DOCTYPE html>
<html>
<head>
    <title>Customer Module</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Customers List</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Contact Person</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
        <?php
        require_once('Customer.php'); // Include the Customer class here
        $allCustomers = Customer::getAllCustomers();
        foreach ($allCustomers as $customer) {
            echo "<tr>";
            echo "<td>" . $customer->getId() . "</td>";
            echo "<td>" . $customer->getCustomerName() . "</td>";
            echo "<td>" . $customer->getContactPerson() . "</td>";
            echo "<td>" . $customer->getEmail() . "</td>";
            echo "<td>" . $customer->getPhone() . "</td>";
            echo "<td>";
            echo "<button class='delete-button' data-id='" . $customer->getId() . "'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h1>Add New Customer</h1>
    <form id="add-customer-form">
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required><br>

        <label for="contact_person">Contact Person:</label>
        <input type="text" id="contact_person" name="contact_person" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required><br>

        <input type="submit" value="Add Customer">
    </form>

    <script>
        $(document).ready(function() {
            // Delete customer on button click
            $('.delete-button').on('click', function() {
                const customerId = $(this).data('id');
                if (confirm('Are you sure you want to delete this customer?')) {
                    $.ajax({
                        url: 'delete_customer.php',
                        method: 'POST',
                        data: { id: customerId },
                        success: function(response) {
                            alert(response);
                            location.reload(); // Refresh the page to reflect changes
                        },
                        error: function() {
                            alert('Failed to delete customer.');
                        }
                    });
                }
            });

            // Add new customer using AJAX
            $('#add-customer-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'add_customer.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        alert(response);
                        location.reload(); // Refresh the page to reflect changes
                    },
                    error: function() {
                        alert('Failed to add customer.');
                    }
                });
            });
        });
    </script>
</body>
</html>
