<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>فرم ثبت نام</title>
  <link rel="stylesheet" href="{{ asset('assets/style/signup.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
</head>
<body>
  <div class="wrapper">
    <h2>ثبت نام کاربر جدید</h2>

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

    @if(session('success'))
    <div class="alert alert-success">
      <i class="fas fa-check-circle"></i> {{ session('success') }}
      <div class="loading-bar"></div>
    </div>
    <script>
      // شروع انیمیشن بارگذاری
      document.querySelector('.loading-bar').style.width = '100%';

      // هدایت پس از 3 ثانیه
      setTimeout(function() {
        window.location.href = "{{ route('login.show') }}";
      }, 3000);
    </script>
    @endif

    <form method="POST" action="{{ route('register.store') }}" id="registerForm">
      @csrf

      <div class="input-box">
        <input type="text" name="name" placeholder="نام و نام خانوادگی" class="@error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="input-box">
        <input type="email" name="email" placeholder="آدرس ایمیل" class="@error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="input-box">
        <input type="password" name="password" placeholder="رمز عبور" class="@error('password') is-invalid @enderror" required autocomplete="new-password">
        @error('password')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="input-box">
        <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور" required autocomplete="new-password">
      </div>

      <div class="form-check">
        <input type="checkbox" name="terms" id="terms" class="form-check-input" required>
        <label for="terms" class="form-check-label">شرایط و قوانین را می‌پذیرم</label>
        @error('terms')
          <span class="invalid-feedback">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="input-box button">
        <input type="submit" value="ثبت نام" id="submitBtn">
      </div>

      <div class="text">
        <span>حساب کاربری دارید؟ <a href="{{ route('login.show') }}">ورود به سیستم</a></span>
      </div>
    </form>
  </div>

  <script>
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      const submitBtn = document.getElementById('submitBtn');
      submitBtn.value = 'در حال ثبت اطلاعات...';
      submitBtn.disabled = true;

      if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        submitBtn.value = 'ثبت نام';
        submitBtn.disabled = false;
      }

      this.classList.add('was-validated');
    });
  </script>
</body>
</html>
