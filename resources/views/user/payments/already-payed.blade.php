<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت ناموفق</title>
    <style>
        body {
            font-family: 'IRANSans', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #fffbeb 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: white;
            padding: 3rem;
            border-radius: 1.5rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 90%;
            position: relative;
            z-index: 1;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        .error-icon {
            color: #f1c30a;
            font-size: 5rem;
            margin-bottom: 1.5rem;
            animation: shake 0.8s ease-in-out;
        }

        h1 {
            color: #f1c30a;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }

        p {
            color: #666;
            margin-bottom: 2.5rem;
            line-height: 1.8;
            font-size: 1.1rem;
        }

        .button {
            background: linear-gradient(135deg, #f6d665 0%, #efc110 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(255, 190, 25, 0.2);
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(244, 206, 54, 0.3);
        }

        .support-info {
            background-color: #eeae16;
            padding: 15px 25px;
            border-radius: 8px;
            margin: 20px 0;
            color: #ffffff;
            font-size: 0.9rem;
            border: 1px solid #f1dd9f;
        }

        .support-info a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
        }

        .support-info a:hover {
            text-decoration: underline;
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="error-icon">!</div>
    <h1>پرداخت تکراری</h1>
    <p>پرداخت این سفارش قبلا انجام شده است</p>
    <div class="support-info">
        برای راهنمایی بیشتر با پشتیبانی تماس بگیرید:
        <a href="tel:۰۹۱۵۳۹۰۰۶۱۶">۰۹۱۵۳۹۰۰۶۱۶</a>
    </div>
    <a href="https://magrico.ir" class="button">بازگشت به صفحه اصلی</a>
</div>
</body>
</html>
