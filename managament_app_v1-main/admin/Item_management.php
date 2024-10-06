<?php
require_once '../inc/connection.php';

// Check if data is being posted (e.g., from the add or remove forms)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        // Add new part
        $partName = $_POST['addItem'];
        $quantity = $_POST['addQuantity'];
        $date = date('Y-m-d H:i:s');

        $sql = "INSERT INTO items (item_name, item_quantity, add_item_date) VALUES ('$partName', '$quantity', '$date')";
        $conn->query($sql);
    } elseif (isset($_POST['remove'])) {
    // Remove part
    $partName = $_POST['removeSelect'];

    $sql = "DELETE FROM items WHERE item_name = '$partName'";
    $conn->query($sql);
    }
}

// Retrieve items data from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);

$items = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الأصناف</title>
    <link rel="stylesheet" href="../css/admin_styles/admined.css">
</head>
<body>

<!-- header  -->
<header>
    <nav>
        <ul>
            <li><a href="./" class="nav-button">الرئيسية</a></li>
            <li><a href="#" class="nav-button">من نحن</a></li>
        </ul>
    </nav>
</header>

<main>

    <!-- Add Item Section -->
    <div class="section-container">
        <h3>إضافة الأصناف</h3>
        <div style="display: flex; align-items: center;">
            <label for="addItem">أدخل اسم الصنف:</label>
            <input type="text" id="addItem" class="input" placeholder="اسم الصنف">

            <label for="addQuantity">الكمية:</label>
            <input type="number" id="addQuantity" class="quantity-input" placeholder="الكمية">
        </div>
        <button class="button" onclick="confirmAdd()">إضافة</button>
    </div>

    <!-- Remove Item Section -->
    <div class="section-container">
        <h3>حذف الأصناف</h3>
        <div>
            <label for="removeSelect">اختر الصنف الذي تريد حذفه:</label>
            <select id="removeSelect" class="select-input">
                <?php foreach ($items as $part) { ?>
                    <option value="<?= $part['item_name'] ?>"><?= $part['item_name'] ?></option>
                <?php } ?>
            </select>
            <button class="button" onclick="confirmRemove()">حذف</button>
        </div>
    </div>

    <!-- Display Table of Items -->
    <table>
        <thead>
            <tr>
                <th>اسم القطعة</th>
                <th>الكمية</th>
                <th>تاريخ الإضافة</th>
            </tr>
        </thead>
        <tbody id="itemsTableBody">
            <?php foreach ($items as $item) { ?>
                <tr>
                    <td><?= $item['item_name'] ?></td>
                    <td><?= $item['item_quantity'] ?></td>
                    <td><?= $item['add_item_date'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        // Function to add a new item
        function confirmAdd() {
            var itemName = document.getElementById('addItem').value;
            var quantity = document.getElementById('addQuantity').value;
            var formData = new FormData();
            formData.append('add', 'true');
            formData.append('addItem', itemName);
            formData.append('addQuantity', quantity);
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Update the table dynamically updateTable();
            });
        }

        // Function to remove a item
        function confirmRemove() {
            var itemName = document.getElementById('removeSelect').value;
            var formData = new FormData();
            formData.append('remove', 'true');
            formData.append('removeSelect', itemName);
            fetch('<?php echo $_SERVER['PHP_SELF']; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Update the table dynamically
                updateTable();
            });
        }

        // Function to update the table dynamically
        function updateTable() {
            var tableBody = document.getElementById('itemsTableBody');
            tableBody.innerHTML = '';
            <?php foreach ($items as $item) { ?>
                var row = document.createElement('tr');
                row.innerHTML = `
                    <td><?= $item['item_name'] ?></td>
                    <td><?= $item['item_quantity'] ?></td>
                    <td><?= $item['add_item_date'] ?></td>
                `;
                tableBody.appendChild(row);
            <?php } ?>
        }
    </script>
</main>

</body>
</html>