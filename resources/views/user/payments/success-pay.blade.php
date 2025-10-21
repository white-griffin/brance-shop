<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پرداخت موفق</title>
    <style>
        @keyframes confetti {
            0% { transform: translateY(-800px) rotate(0deg); }
            100% { transform: translateY(100vh) rotate(360deg); }
        }

        .confetti {
            position: fixed;
            width: 10px;
            height: 10px;
            background-color: #f00;
            animation: confetti 3s ease-in-out forwards;
        }

        body {
            font-family: 'IRANSans', Arial, sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #e8f5e9 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            overflow: hidden;
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
            from { opacity: 0; transform: translateY(200px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-icon {
            color: #4CAF50;
            font-size: 5rem;
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
            position: relative;
        }

        .success-icon:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 120%;
            height: 120%;
            border-radius: 50%;
            z-index: -1;
            animation: pulse-ring 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        h1 {
            color: #2e7d32;
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
            background: linear-gradient(135deg, #4CAF50 0%, #2e7d32 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(76, 175, 80, 0.2);
            position: relative;
            overflow: hidden;
            margin: 10px;
            min-width: 180px;
        }

        .button:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(76, 175, 80, 0.3);
        }

        .button:hover:before {
            left: 100%;
        }

        .button.secondary {
            background: white;
            color: #2e7d32;
            border: 2px solid #4CAF50;
        }

        .button.secondary:hover {
            background: #e8f5e9;
        }

        .success-message {
            background-color: #f1f8e9;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            color: #558b2f;
            font-size: 0.9rem;
            border-right: 4px solid #8bc34a;
        }

        .buttons-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            gap: 5px;
            margin-top: 20px;
        }

        @media (max-width: 480px) {
            .buttons-container {
                flex-direction: column;
            }

            .button {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="success-icon">✓</div>
    <h1>پرداخت موفق</h1>
    <p>پرداخت شما با موفقیت انجام شد</p>
    <div class="success-message">
        تراکنش شما با موفقیت ثبت شد
    </div>
    <div class="buttons-container">
        <a href="https://magrico.ir/order" class="button secondary">پیگیری سفارش</a>
        <a href="https://magrico.ir" class="button">بازگشت به صفحه اصلی</a>
    </div>
</div>

<script>
    function createConfetti() {
        const colors = ['#4CAF50', '#FFC107', '#FF5722', '#2196F3', '#9C27B0'];
        for (let i = 0; i < 100; i++) {
            const confetti = document.createElement('div');
            confetti.className = 'confetti';
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
            confetti.style.animationDuration = Math.random() * 3 + 2 + 's';
            confetti.style.opacity = Math.random();
            confetti.style.width = Math.random() * 10 + 5 + 'px';
            confetti.style.height = Math.random() * 10 + 5 + 'px';
            document.body.appendChild(confetti);
            setTimeout(() => confetti.remove(), 5000);
        }
    }

    window.onload = createConfetti;
</script>
</body>
</html>
