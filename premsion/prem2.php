<?php
session_start();

// Path to the JSON file
$json_file = 'disabled_buttons.json';

// Check if the JSON file exists, if not, create it with an empty structure
if (!file_exists($json_file)) {
    file_put_contents($json_file, json_encode([]));
}

// Load the current disabled buttons data
$disabled_buttons_data = file_get_contents($json_file);
$disabled_buttons_array = json_decode($disabled_buttons_data, true);

// Check if the array is null (in case the file content is corrupted or empty), and initialize it
if ($disabled_buttons_array === null) {
    $disabled_buttons_array = [];
}

// Assuming the admin is controlling buttons for the user 'ss'
$user = 'ss';

// If the form is submitted, update the disabled buttons
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the selected buttons to disable from the form
    $disabled_buttons = isset($_POST['disabled_buttons']) ? $_POST['disabled_buttons'] : [];

    // Update the JSON file with the selected buttons for the user 'ss'
    $disabled_buttons_array[$user] = $disabled_buttons;

    // Save the updated data to the JSON file
    file_put_contents($json_file, json_encode($disabled_buttons_array));

    // Display a success message (optional)
    echo "<p>تم تحديث الأزرار المعطلة بنجاح.</p>";
}

// List of all buttons that can be disabled
$all_buttons = ['المخزون', 'طلبات الحاسب الالي', 'طلبات صيانة الحاسب الالي', 'استعلام الرجيع'];
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة التحكم بالمستخدم</title>
    <link rel="stylesheet" href="../css/admin_styles/admin.css">
</head>
<body>
    <header>
        <nav class="navbar-container">
            <a href="#" class="navbar-link">الرئيسية</a>
            <a href="whowere.html" class="navbar-link">من نحن</a>
            <a href="./auth/logout.php" class="navbar-link">تسجيل خروج</a>
        </nav>
    </header>

    <h1>صفحة التحكم بالمستخدم</h1>

    <main>
        <div class="button-container">
            <!-- Form to select which buttons to disable -->
            <form method="POST">
                <p>اختر الأزرار التي ترغب في تعطيلها:</p>

                <?php foreach ($all_buttons as $button): ?>
                    <div>
                        <label>
                            <input type="checkbox" name="disabled_buttons[]" value="<?php echo $button; ?>" 
                            <?php if (isset($disabled_buttons_array[$user]) && in_array($button, $disabled_buttons_array[$user])) echo 'checked'; ?>>
                            <?php echo $button; ?>
                        </label>
                    </div>
                <?php endforeach; ?>

                <button type="submit">تحديث الأزرار المعطلة</button>
            </form>

            <!-- Button to go back to prem1.php -->
            <a href="prem1.php" class="button-link">العودة إلى prem1</a>
        </div>
    </main>
</body>
</html>
