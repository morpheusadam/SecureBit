<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منو اصلی</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            font-family: 'Vazir', sans-serif;
        }
        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 300px;
            margin: 0 auto;
        }
        .btn {
            padding: 12px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="btn-container">
        @auth
            <!-- دکمه‌های نمایشی برای کاربران لاگین کرده -->
            <a href="{{ route('dashboard.index') }}" class="btn btn-primary">
                <i class="fas fa-tachometer-alt"></i> داشبورد
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt"></i> خروج
                </button>
            </form>
        @else
            <!-- دکمه‌های نمایشی برای کاربران مهمان -->
            <a href="{{ route('login.show') }}" class="btn btn-success">
                <i class="fas fa-sign-in-alt"></i> ورود
            </a>
            <a href="{{ route('register.show') }}" class="btn btn-info">
                <i class="fas fa-user-plus"></i> ثبت نام
            </a>
        @endauth
    </div>

    <!-- آیکون‌های فونت آوسام -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>