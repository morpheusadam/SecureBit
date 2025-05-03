<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود به سیستم</title>
  <link rel="stylesheet" href="{{ asset('assets/style/login.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="wrapper">
    <h2>ورود به حساب کاربری</h2>

    @if(session('error'))
    <div class="alert alert-danger">
      <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}" id="loginForm">
      @csrf

      <div class="input-box">
        <input type="email" name="email" placeholder="آدرس ایمیل" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="input-box">
        <input type="password" name="password" placeholder="رمز عبور" required autocomplete="current-password">
        @error('password')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="form-check">
        <input type="checkbox" name="remember" id="remember" class="form-check-input">
        <label for="remember" class="form-check-label">مرا به خاطر بسپار</label>
      </div>

      <div class="input-box button">
        <input type="submit" value="ورود" id="submitBtn">
      </div>

      <div class="text">
        <span>حساب کاربری ندارید؟ <a href="{{ route('register.show') }}">ثبت نام کنید</a></span>
      </div>

      @if (Route::has('password.request'))
      <div class="forgot-password">
        <a href="{{ route('password.request') }}">رمز عبور خود را فراموش کرده‌اید؟</a>
      </div>
      @endif
    </form>
  </div>

  <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      submitBtn.value = 'در حال ورود...';
      submitBtn.disabled = true;

      if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        submitBtn.value = 'ورود';
        submitBtn.disabled = false;
      }
    });
  </script>
</body>
</html>
