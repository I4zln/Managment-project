<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استعلام الرجيع</title>

    <style>
        /* Navbar Styles */
        header {
            width: 100%;
            background-color: #00796b;
            padding: 10px 0;
            position: fixed;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-bottom: 3px solid #004d40;
            display: flex;
            justify-content: center; /* Center the links */
        }

        /* Navbar Container */
        .navbar-container {
            display: flex;
            justify-content: center;
            gap: 50px; /* Space between the links */
        }

        .navbar-link {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .navbar-link:hover {
            background-color: #004d40;
            color: #e0f2f1;
            transform: scale(1.05);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* General Styles */
        body {
            font-family: Arial, sans-serif; /* Use a readable font */
            margin-top: 70px; /* Add margin for fixed header */
            background-color: #f5f5f5; /* Light background for contrast */
        }

        h2 {
            text-align: center;
            color: #00796b; /* Consistent color with the navbar */
            margin: 20px 0;
        }

        form {
            background-color: #fff; /* White background for forms */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px auto; /* Center the form */
            width: 90%; /* Set width to 90% */
            max-width: 600px; /* Set a max width */
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
            width: calc(100% - 22px); /* Full width accounting for padding */
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

        /* User Notifications */
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

        /* Table Styles */
        table {
            width: 90%; /* Set table width */
            margin: 20px auto; /* Center the table */
            border-collapse: collapse; /* Collapsing borders */
            background-color: #fff; /* White background for tables */
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

        /* Results Table */
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
        <!-- استعلام حول الرجيع -->
        <h2>استعلام الرجيع</h2>
        <form id="query-form">
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
        <div id="alert" class="alert"></div>

        <!-- جدول طلبات رجيع الأجهزة -->
        <h2>طلبات رجيع الأجهزة</h2>
        <table>
            <thead>
                <tr>
                    <th>التاريخ</th>
                    <th>اسم المدرسة / القسم / الإدارة</th>
                    <th>اسم الجهاز</th>
                    <th>رقم التسلسل</th>
                    <th>حالة الجهاز</th>
                    <th>وصف السبب</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2024-10-01</td>
                    <td>مدرسة الأمل</td>
                    <td>حاسب آلي</td>
                    <td>12345ABC</td>
                    <td>معطل</td>
                    <td>توقف عن التشغيل بشكل مفاجئ</td>
                </tr>
                <tr>
                    <td>2024-09-28</td>
                    <td>قسم التقنية</td>
                    <td>شاشة حاسب آلي</td>
                    <td>67890XYZ</td>
                    <td>متضرر</td>
                    <td>كسور في الشاشة</td>
                </tr>
            </tbody>
        </table>

        <!-- جدول النتائج بناءً على الاستعلام -->
        <div id="results">
            <h2>نتائج الاستعلام</h2>
            <table id="results-table">
                <thead>
                    <tr>
                        <th>التاريخ</th>
                        <th>اسم المدرسة / القسم / الإدارة</th>
                        <th>اسم الجهاز</th>
                        <th>رقم التسلسل</th>
                        <th>حالة الجهاز</th>
                        <th>وصف السبب</th>
                    </tr>
                </thead>
                <tbody id="results-body">
                    <!-- سيتم تعبئة النتائج هنا -->
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // تفاعل الفورم باستخدام JavaScript
        document.getElementById('query-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const startDate = document.getElementById('start-date').value;
            const endDate = document.getElementById('end-date').value;
            const tableQuery = document.getElementById('table-query').value;
            const alertBox = document.getElementById('alert');
            const resultsTable = document.getElementById('results');
            const resultsBody = document.getElementById('results-body');

            if (new Date(startDate) > new Date(endDate)) {
                alertBox.innerHTML = 'خطأ: تأكد من أن تاريخ النهاية أكبر من تاريخ البداية.';
                alertBox.className = 'alert alert-error';
                alertBox.style.display = 'block';
                resultsTable.style.display = 'none';
            } else {
                // إعادة تعيين إشعار المستخدم
                alertBox.style.display = 'none';

                // تنفيذ الاستعلام (محاكاة الاستعلام من خلال بيانات افتراضية)
                let data = [
                    {date: '2024-10-01', name: 'مدرسة الأمل', device: 'حاسب آلي', serial: '12345ABC', condition: 'معطل', reason: 'توقف عن التشغيل بشكل مفاجئ'},
                    {date: '2024-09-28', name: 'قسم التقنية', device: 'شاشة حاسب آلي', serial: '67890XYZ', condition: 'متضرر', reason: 'كسور في الشاشة'},
                ];

                // تصفية البيانات حسب التاريخ (تمت المحاكاة)
                const filteredData = data.filter(item => {
                    return new Date(item.date) >= new Date(startDate) && new Date(item.date) <= new Date(endDate);
                });

                // تعبئة جدول النتائج
                resultsBody.innerHTML = '';
                filteredData.forEach(item => {
                    const row = `<tr>
                        <td>${item.date}</td>
                        <td>${item.name}</td>
                        <td>${item.device}</td>
                        <td>${item.serial}</td>
                        <td>${item.condition}</td>
                        <td>${item.reason}</td>
                    </tr>`;
                    resultsBody.innerHTML += row;
                });

                // إظهار جدول النتائج إذا كان هناك نتائج
                if (filteredData.length > 0) {
                    resultsTable.style.display = 'block';
                } else {
                    resultsTable.style.display = 'none';
                    alertBox.innerHTML = 'لا توجد نتائج مطابقة للاستعلام.';
                    alertBox.className = 'alert alert-error';
                    alertBox.style.display = 'block';
                }
            }
        });
    </script>
</body>
</html>
