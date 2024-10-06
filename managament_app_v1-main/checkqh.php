<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب رجيع</title>
    <link rel="stylesheet" href="./css/checkqc.css">
    <style>
        .error-message {
            color: red;
            font-weight: bold;
            font-size: 18px;
        }

        .answer-input {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        .submit-button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .download-button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="navbar-container">
            <a href="./" class="navbar-link home-link">الرئيسية</a>
            <a href="#about" class="navbar-link center-link">من نحن</a>
            <a href="https://wa.me/966534435949" class="navbar-link contact-link">تواصل معنا</a>
        </div>
    </header>

    <main>
        <section class="intro">
            <h1>طلب رجيع</h1>

            <!-- Red Message Below Title -->
            <p class="error-message">(هذه الصفحة مخصصة لرجيع الحاسب الآلي وملحقاته فقط)</p>

            <!-- Form Start -->
            <form id="return-form">
                <!-- Field 1: اسم الجهة -->
                <div class="question-container">
                    <div class="question-text">
                        <label for="department-name" class="question-label">اسم الجهة</label>
                        <input type="text" id="department-name" placeholder="ادخل اجابتك" class="answer-input" required>
                    </div>
                </div>

                <!-- Field 2: اسم المدير -->
                <div class="question-container">
                    <div class="question-text">
                        <label for="manager-name" class="question-label">اسم المدير</label>
                        <input type="text" id="manager-name" placeholder="ادخل اجابتك" class="answer-input" required>
                    </div>
                </div>

                <!-- Field 3: رقم الجوال -->
                <div class="question-container">
                    <div class="question-text">
                        <label for="phone-number" class="question-label">رقم الجوال</label>
                        <input type="tel" id="phone-number" placeholder="ادخل رقم الجوال" class="answer-input" pattern="[0-9]{10}" required>
                    </div>
                </div>

                <!-- Word File Download Button -->
                <div class="download-container">
                    <button type="button" class="download-button">تحميل ملف الرجيع (Word)</button>
                    <p class="error-message">(الرجاء تعبئة النموذج الموجود أسفل الصفحة وتعبئته بواسطة الحاسب الآلي ثم إرساله على البريد الإلكتروني التالي: workshop@mkhb.moe.gov.sa)</p>
                </div>

                <!-- Submit Button -->
                <div class="submit-container">
                    <button type="submit" class="submit-button">إرسال</button>
                </div>
            </form>
        </section>

        <script>
            // Prevent submission if not all fields are filled
            document.getElementById("return-form").addEventListener("submit", function(event) {
                let departmentName = document.getElementById("department-name").value;
                let managerName = document.getElementById("manager-name").value;
                let phoneNumber = document.getElementById("phone-number").value;

                if (departmentName === "" || managerName === "" || phoneNumber === "") {
                    alert("الرجاء تعبئة جميع الحقول.");
                    event.preventDefault(); // Prevent form submission
                }

                // Ensure the phone number contains only numbers and is 10 digits
                if (!/^[0-9]{10}$/.test(phoneNumber)) {
                    alert("الرجاء إدخال رقم جوال صحيح مكون من 10 أرقام.");
                    event.preventDefault(); // Prevent form submission
                }
            });
        </script>
    </main>
</body>
</html>
