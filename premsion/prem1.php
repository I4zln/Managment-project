<?php
session_start();

// Load the JSON file with disabled buttons
$disabled_buttons_data = file_get_contents('disabled_buttons.json');
$disabled_buttons_array = json_decode($disabled_buttons_data, true);

// Get the currently disabled buttons for user 'ss'
$user = 'ss'; // Assuming 'ss' is the user, you can make this dynamic based on session if needed
$disabled_buttons = $disabled_buttons_array[$user] ?? [];

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة المستخدم</title>
    <link rel="stylesheet" href="../css/admin_styles/admin.css">
    <style>
        /* Clear/Disabled button style */
        .disabled-button {
            background-color: transparent;
            color: #ccc;
            pointer-events: none; /* Makes the button unclickable */
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar-container">
            <a href="#" class="navbar-link">الرئيسية</a>
            <a href="whowere.html" class="navbar-link">من نحن</a>
            <a href="./auth/logout.php" class="navbar-link">تسجيل خروج</a>
        </nav>
    </header>

    <h1>أهلا بك في صفحة الاستعلامات</h1>

    <main>
        <div class="button-container">
            <!-- المخزون button -->
            <a href="./item.php" class="button-link <?php if (in_array('المخزون', $disabled_buttons)) echo 'disabled-button'; ?>">المخزون</a>

            <!-- طلبات الحاسب الالي button -->
            <a href="querypf.php" class="button-link <?php if (in_array('طلبات الحاسب الالي', $disabled_buttons)) echo 'disabled-button'; ?>">طلبات الحاسب الالي</a>

            <!-- طلبات صيانة الحاسب الالي button -->
            <a href="queryh.php" class="button-link <?php if (in_array('طلبات صيانة الحاسب الالي', $disabled_buttons)) echo 'disabled-button'; ?>">طلبات صيانة الحاسب الالي</a>

            <!-- استعلام الرجيع button -->
            <a href="./returndiv.php" class="button-link <?php if (in_array('استعلام الرجيع', $disabled_buttons)) echo 'disabled-button'; ?>">استعلام الرجيع</a>

            <!-- Button to go to prem2.php -->
            <a href="prem2.php" class="button-link">Go to prem2</a>
        </div>
    </main>

</body>
</html>
