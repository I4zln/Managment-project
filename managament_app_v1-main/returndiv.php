<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استعلام الرجيع</title>
    <link rel="stylesheet" href="querycc.css">
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
            <a href="admin.html" class="navbar-link">الرئيسية</a>
            <a href="whowere.html" class="navbar-link">من نحن</a>
        </nav>
    </header>

    <main>
        <!-- نموذج الاستعلام حول الرجيع -->
        <h2>استعلام الرجيع</h2>
        <form id="query-form" method="POST" action="">
            <label for="start-date">اختر تاريخ البداية:</label>
            <input type="date" id="start-date" name="start-date" required>
            
            <label for="end-date">اختر تاريخ النهاية:</label>
            <input type="date" id="end-date" name="end-date" required>
            
            <label for="table-query">اختر الجدول للاستعلام:</label>
            <select id="table-query" name="table-query">
                <option value="return-items">طلبات رجيع الأجهزة</option>
            </select>
            
            <button type="submit">استعلام</button>
        </form>

        <!-- إشعارات للمستخدم -->
        <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $startDate = $_POST['start-date'];
                $endDate = $_POST['end-date'];

                if ($startDate > $endDate) {
                    echo '<div class="alert alert-error">خطأ: تأكد من أن تاريخ النهاية أكبر من تاريخ البداية.</div>';
                } else {
                    echo '<div class="alert alert-success">تم الاستعلام بنجاح.</div>';

                    // بيانات افتراضية (يمكن استبدالها بقاعدة بيانات حقيقية)
                    $data = [
                        ['date' => '2024-10-01', 'name' => 'مدرسة الأمل', 'device' => 'حاسب آلي', 'serial' => '12345ABC', 'condition' => 'معطل', 'reason' => 'توقف عن التشغيل بشكل مفاجئ'],
                        ['date' => '2024-09-28', 'name' => 'قسم التقنية', 'device' => 'شاشة حاسب آلي', 'serial' => '67890XYZ', 'condition' => 'متضرر', 'reason' => 'كسور في الشاشة']
                    ];

                    // عرض جدول النتائج
                    echo '<div id="results">';
                    echo '<h2>نتائج الاستعلام</h2>';
                    echo '<table>';
                    echo '<thead><tr><th>التاريخ</th><th>اسم المدرسة / القسم / الإدارة</th><th>اسم الجهاز</th><th>رقم التسلسل</th><th>حالة الجهاز</th><th>وصف السبب</th></tr></thead>';
                    echo '<tbody>';

                    // عرض البيانات بناءً على الاستعلام (افتراضياً هنا تعرض جميع البيانات)
                    foreach ($data as $item) {
                        echo '<tr>';
                        echo '<td>' . $item['date'] . '</td>';
                        echo '<td>' . $item['name'] . '</td>';
                        echo '<td>' . $item['device'] . '</td>';
                        echo '<td>' . $item['serial'] . '</td>';
                        echo '<td>' . $item['condition'] . '</td>';
                        echo '<td>' . $item['reason'] . '</td>';
                        echo '</tr>';
                    }

                    echo '</tbody></table></div>';
                }
            }
        ?>
    </main>
</body>
</html>
