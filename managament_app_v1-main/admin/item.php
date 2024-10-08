<?php
require_once '../inc/connection.php';

session_start();

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: ./auth/login.php");
    exit;
}
// Fetch deleted parts from database
$sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استعلام عن القطع </title>
    <link rel="stylesheet" href="../css/itemc.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f4f3;
            transition: background-color 0.3s ease;
            overflow-y: auto;
        }

        /* Navbar Styles */
        header {
            width: 100%;
            background-color: #00796b;
            padding: 10px 0;
        }

        .navbar-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .navbar-link {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            margin: 0 30px;
        }

        .navbar-link:hover {
            background-color: #004d40;
            transform: scale(1.05);
        }

        main {
            margin-top: 80px;
            text-align: center;
            width: 70%;
            max-width: 800px;
            padding: 0 20px;
        }

        h2 {
            font-size: 24px;
            color: #00796b;
            margin-bottom: 20px;
        }

        .search-container {
            border: 2px solid #00796b;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        .search-container label {
            font-size: 18px;
            color: #00796b;
        }

        .search-container input[type="date"] {
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            border: 1px solid #00796b;
            border-radius: 5px;
            background-color: #f0f4f3;
            font-size: 16px;
        }

        .search-container button {
            padding: 10px 20px;
            margin-top: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            background-color: #00796b;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #004d40;
        }

        table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            text-align: center;
        }

        th {
            background-color: #00796b;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0f2f1;
        }

        .no-results {
            color: #00796b;
            font-size: 18px;
            margin-top: 20px;
        }

        footer {
            background-color: #00796b;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .footer-text {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar-container">
            <a href="./" class="navbar-link">الرئيسية</a>
            <a href="#" class="navbar-link">من نحن</a>
        </nav>
    </header>

    <main>
        <h2>استعلام عن القطع </h2>

        <!-- Search Container for Interactive Filtering -->
        <form method="post" action="item.php">
            <div class="search-container">
                <label for="startDate">اختر تاريخ البداية:</label>
                <input type="date" id="startDate" name="startDate" value="<?php echo isset($_GET['startDate']) ? $_GET['startDate'] : ''; ?>">
                <br>
                <label for="endDate">اختر تاريخ النهاية:</label>
                <input type="date" id="endDate" name="endDate" value="<?php echo isset($_GET['endDate']) ? $_GET['endDate'] : ''; ?>">
                <br>
                <button name="sumbit_date">بحث</button>
            </div>
        </form>
        <br>
        <?php

        if (isset($_POST['sumbit_date'])) {

            $start_date = $_POST['startDate'];
            $end_date = $_POST['endDate'];

            $query = mysqli_query($conn, "SELECT * from items where add_item_date between '$start_date' and '$end_date' ");

            if (mysqli_num_rows($query) > 0) { ?>


                <table>
                    <thead>
                        <tr>
                            <th>اسم القطعة</th>
                            <th>الكمية</th>
                            <th>تاريخ الإضافة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($query as $value) { ?>
                            <tr>

                                <td><?= $value['item_name'] ?></td>
                                <td><?= $value['item_quantity'] ?></td>
                                <td><?= $value['add_item_date'] ?></td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            <?php

            }else{
                echo '<p class="no-results">لا توجد نتائج.</p>';
            }
        } else {

            ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم القطعة</th>
                        <th>الكمية</th>
                        <th>تاريخ الإضافة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_id = $row['id'];
                        $item_name = $row['item_name'];
                        $item_quantity = $row['item_quantity'];
                        $add_item_date = $row['add_item_date'];


                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $item_name; ?></td>
                            <td><?= $item_quantity; ?></td>
                            <td><?= $add_item_date; ?></td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>
        <?php } ?>
    </main>

</body>

</html>