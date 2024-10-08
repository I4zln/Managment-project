<?php
session_start();

if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
    header("Location: ./auth/login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة المشرف</title>
    <link rel="stylesheet" href="../css/admin_styles/admin.css">
</head>
<body>
    <header>
        <nav class="navbar-container">
            <a href="../" class="navbar-link">الرئيسية</a>
            <a href="whowere.html" class="navbar-link">من نحن</a>
            <a href="./auth/logout.php" class="navbar-link">تسجيل خروج</a>
        </nav>
    </header>

    <img src="../images/cropimage.png" alt="شعار" class="logo"> <!-- شعار خارج الهيدر -->

    <main>
            <div class="welcome-message">
            <h2>مرحبًا بك أستاذ | <?php echo isset($_SESSION["admin_name"]) ? $_SESSION["admin_name"] : 'Unknown'; ?></h2>
            <p>يرجى اختيار أحد الخيارات من الأسفل لإدارة الموقع.</p>
        </div>

        <div class="button-container">
            <a href="./item.php" class="button-link">المخزون</a>
            <a href="removepart.php" class="button-link">صرف القطع</a>
            <a href="addparts.php" class="button-link">إضافة كمية</a>
            <a href="./Item_management.php" class="button-link">إدارة الأصناف</a>
            <a href="queryh.php" class="button-link">استعلام عن الطلبات</a> 
            <a href="querypf.php" class="button-link">طلبات الحاسب الآلي</a> 
            <a href="queryh.php" class="button-link">طلبات صيانة الحاسب الالي</a> 
            <a href="adimnedh.php" class="button-link">صفحة التعديلات</a>
            <a href="./add_admin.php" class="button-link">إضافة مسؤول في النظام</a> 
            <a href="./returndiv.php "class="button-link">استعلام الرجيع</a> 
        </div>

            
    </main>

    <?php
// Example: Fetch the permissions from the database (replace with your actual database query)
// Assume you already have a database connection in $conn

$sql = "SELECT permissions FROM admins WHERE id = 1"; // Replace with your actual query
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    // Assuming the permissions are stored as a comma-separated string
    $permissions_str = $row['permissions'];
    
    // Convert the permissions string back to an array
    $permissions_array = explode(", ", $permissions_str);

    // Display the permissions on the index page
    echo "<h3>الأذونات:</h3>";
    echo "<ul>";
    foreach ($permissions_array as $permission) {
        echo "<li>" . htmlspecialchars($permission) . "</li>";
    }
    echo "</ul>";
} else {
    echo "لم يتم العثور على الأذونات.";
}
?>


</body>
</html>
