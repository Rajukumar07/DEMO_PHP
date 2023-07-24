<!DOCTYPE html>
<html>
<head>
    <title>Report Module</title>
</head>
<body>
    <h1>Inventory Reports</h1>
    <ul>
    <li><a href="reports.php?report_type=all_items">All Inventory Items Report</a></li>
        <li><a href="reports.php?report_type=low_stock">Low Stock Items Report</a></li>
        <li><a href="reports.php?report_type=sales">Sales Report</a></li>
        <li><a href="reports.php?report_type=purchases">Purchase Report</a></li> <!-- Add link to the purchase report -->
        <li><a href="reports.php?report_type=stock">Stock Report</a></li> <!-- Add link to the stock report -->
    </ul>

    <?php
    // Check if the report type is requested
    if (isset($_GET['report_type'])) {
        $reportType = $_GET['report_type'];

        if ($reportType === 'all_items') {
            // Generate the All Inventory Items Report
            generateAllItemsReport();
        } elseif ($reportType === 'low_stock') {
            // Generate the Low Stock Items Report
            generateLowStockReport();
        } elseif ($reportType === 'sales') {
            // Generate the Sales Report
            generateSalesReport();
        }
    }

    // Function to generate All Inventory Items Report
    function generateAllItemsReport()
    {
        // Include the InventoryItem class here
        require_once('InventoryItem.php');

        $allItems = InventoryItem::getAllItems();

        echo "<h2>All Inventory Items Report</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>";
        foreach ($allItems as $item) {
            echo "<tr>";
            echo "<td>" . $item->getId() . "</td>";
            echo "<td>" . $item->getProductName() . "</td>";
            echo "<td>" . $item->getQuantity() . "</td>";
            echo "<td>" . $item->getPrice() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    // Function to generate Low Stock Items Report
    function generateLowStockReport()
    {
        // Include the InventoryItem class here
        require_once('InventoryItem.php');

        $lowStockItems = InventoryItem::getLowStockItems();

        echo "<h2>Low Stock Items Report</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>";
        foreach ($lowStockItems as $item) {
            echo "<tr>";
            echo "<td>" . $item->getId() . "</td>";
            echo "<td>" . $item->getProductName() . "</td>";
            echo "<td>" . $item->getQuantity() . "</td>";
            echo "<td>" . $item->getPrice() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    // Function to generate Sales Report
    function generateSalesReport()
    {
        // Include the Sale class here
        require_once('Sale.php');

        $allSales = Sale::getAllSales();

        echo "<h2>Sales Report</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Sale Date</th><th>Item Name</th><th>Quantity</th></tr>";
        foreach ($allSales as $sale) {
            $item = InventoryItem::getItemById($sale->getItemId());
            echo "<tr>";
            echo "<td>" . $sale->getId() . "</td>";
            echo "<td>" . $sale->getSaleDate() . "</td>";
            echo "<td>" . $item->getProductName() . "</td>";
            echo "<td>" . $sale->getQuantity() . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

      // Function to generate Purchase Report
      function generatePurchaseReport()
      {
          // Include the Purchase class here
          require_once('Purchase.php');
  
          $allPurchases = Purchase::getAllPurchases();
  
          echo "<h2>Purchase Report</h2>";
          echo "<table>";
          echo "<tr><th>ID</th><th>Purchase Date</th><th>Item Name</th><th>Quantity</th></tr>";
          foreach ($allPurchases as $purchase) {
              $item = InventoryItem::getItemById($purchase->getItemId());
              echo "<tr>";
              echo "<td>" . $purchase->getId() . "</td>";
              echo "<td>" . $purchase->getPurchaseDate() . "</td>";
              echo "<td>" . $item->getProductName() . "</td>";
              echo "<td>" . $purchase->getQuantity() . "</td>";
              echo "</tr>";
          }
          echo "</table>";
      }
  
      // Function to generate Stock Report
      function generateStockReport()
      {
          // Include the InventoryItem class here
          require_once('InventoryItem.php');
  
          $allItems = InventoryItem::getAllItems();
  
          echo "<h2>Stock Report</h2>";
          echo "<table>";
          echo "<tr><th>ID</th><th>Product Name</th><th>Quantity</th><th>Price</th></tr>";
          foreach ($allItems as $item) {
              echo "<tr>";
              echo "<td>" . $item->getId() . "</td>";
              echo "<td>" . $item->getProductName() . "</td>";
              echo "<td>" . $item->getQuantity() . "</td>";
              echo "<td>" . $item->getPrice() . "</td>";
              echo "</tr>";
          }
          echo "</table>";
      }
  
      // Check if the report type is requested
      if (isset($_GET['report_type'])) {
          $reportType = $_GET['report_type'];
  
          if ($reportType === 'all_items') {
              // Generate the All Inventory Items Report
              generateAllItemsReport();
          } elseif ($reportType === 'low_stock') {
              // Generate the Low Stock Items Report
              generateLowStockReport();
          } elseif ($reportType === 'sales') {
              // Generate the Sales Report
              generateSalesReport();
          } elseif ($reportType === 'purchases') {
              // Generate the Purchase Report
              generatePurchaseReport();
          } elseif ($reportType === 'stock') {
              // Generate the Stock Report
              generateStockReport();
          }
      }
    ?>
</body>
</html>
