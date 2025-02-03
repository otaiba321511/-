<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // إعداد الاتصال بقاعدة البيانات
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "your_database_name"; // تأكد من وضع اسم قاعدة البيانات الفعلي

    // الاتصال بقاعدة البيانات
    $conn = new mysqli($servername, $username, $password, $dbname);

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // استلام البيانات من النموذج
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    // التحقق من تطابق كلمة المرور
    if ($password != $confirm_password) {
        echo "كلمات المرور غير متطابقة.";
        exit();
    }

    // تأمين كلمة المرور باستخدام التشفير
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // إدخال البيانات في قاعدة البيانات
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "تم إنشاء الحساب بنجاح!";
    } else {
        echo "حدث خطأ: " . $conn->error;
    }

    // غلق الاتصال
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>إنشاء حساب</h2>
        <form action="sign-up.php" method="POST">
            <div class="form-group">
                <label for="name">الاسم الكامل</label>
                <input type="text" id="name" name="name" placeholder="أدخل اسمك الكامل" required>
            </div>
            <div class="form-group">
                <label for="email">البريد الإلكتروني</label>
                <input type="email" id="email" name="email" placeholder="أدخل بريدك الإلكتروني" required>
            </div>
            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" id="password" name="password" placeholder="أدخل كلمة المرور" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">تأكيد كلمة المرور</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="تأكيد كلمة المرور" required>
            </div>
            <div class="form-group">
                <button type="submit">إنشاء الحساب</button>
            </div>
        </form>
    </div>

</body>
</html>