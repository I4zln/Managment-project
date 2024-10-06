<?php

require_once '../inc/connection.php';
session_start();

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: ./auth/login.php");
    exit;
}

$query_mint = "SELECT * FROM maintenance_request";
$result_mint = mysqli_query($conn, $query_mint);

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلبات الصيانة</title>
    <link rel="stylesheet" href="../css/admin_styles/querycc.css">
    <style>
        /* تنسيقات عامة للجدول */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
            table-layout: auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: center;
            font-size: 16px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #00796b;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            border-bottom: 3px solid #004d40;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e0f7fa;
            transition: background-color 0.3s ease;
        }

        /* تنسيقات لتحسين نموذج الاستعلام */
        form {
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            color: #00796b;
            margin-right: 10px;
        }

        input[type="date"], select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #00796b;
            border-radius: 5px;
            margin: 10px 0;
        }

        button {
            padding: 10px 20px;
            background-color: #00796b;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #004d40;
        }

        /* إشعارات المستخدم */
        .alert {
            display: none;
            padding: 10px;
            margin-top: 15px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* جدول النتائج */
        #results {
            display: none;
            margin-top: 20px;
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
        <!-- نموذج الاستعلام حول الطلبات بناءً على التاريخ -->
        <h2>استعلام حول طلبات صيانة الحاسب الالي</h2>
        <form id="query-form">
            <label for="start-date">اختر تاريخ البداية:</label>
            <input type="date" id="start-date" name="start-date" required>
            
            <label for="end-date">اختر تاريخ النهاية:</label>
            <input type="date" id="end-date" name="end-date" required>
            
            <label for="table-query">اختر الجدول للاستعلام:</label>
            <select id="table-query" name="table-query">
                <option value="maintenance">طلبات صيانة حاسب آلي</option>
            </select>
            
            <button type="submit">استعلام</button>
        </form>

        <!-- إشعارات للمستخدم -->
        <div id="alert" class="alert"></div>

        <!-- جدول طلب صيانة حاسب آلي -->
        <h2>طلبات صيانة حاسب آلي</h2>
        <table>
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>اسم الشخص / المدرسة / القسم</th>
                    <th>نوع الصيانة</th>
                    <th>نوع الجهاز</th>
                    <th>وصف دقيق للمشكلة</th>
                    <th>رقم الهاتف</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result_mint))
            {
                ?>
                <tr>
                    <td><?php echo $row['date'] ?></td>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['maintenance_type'] ?></td>
                    <td><?php echo $row['device_type'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td><?php echo $row['phone_number'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
        </table>

        <!-- جدول النتائج بناءً على الاستعلام -->
        <div id="results">
            <h2>نتائج الاستعلام</h2>
            <table id="results-table">
                <thead>
                    <tr>
                        <th>التاريخ</th>
                        <th>اسم الشخص / المدرسة / القسم</th>
                        <th>نوع الصيانة</th>
                        <th>نوع الجهاز</th>
                        <th>وصف دقيق للمشكلة</th>
                        <th>رقم الهاتف</th>
                    </tr>
                </thead>
                <tbody id="results-body">
                    <!-- سيتم تعبئة النتائج هنا -->
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
