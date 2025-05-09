<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png">
    
    <!-- Loader -->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    
    <!-- Page Title -->
    <title>Login | Management System</title>
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --light-color: #f8fafc;
            --dark-color: #1e293b;
            --border-radius: 0.5rem;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: var(--dark-color);
        }
        
        .bg-login {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
            transition: var(--transition);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .login-separater {
            position: relative;
            margin: 2rem 0;
        }
        
        .login-separater span {
            background-color: #fff;
            padding: 0 1rem;
            position: relative;
            z-index: 1;
            color: var(--secondary-color);
        }
        
        .login-separater hr {
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            margin: 0;
            border-top: 1px solid #e2e8f0;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: var(--transition);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
        }
        
        .input-group-text {
            cursor: pointer;
            transition: var(--transition);
        }
        
        .input-group-text:hover {
            background-color: #e2e8f0;
        }
        
        .floating-alert {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            animation: fadeInDown 0.5s, fadeOutUp 0.5s 2.5s forwards;
        }
        
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeOutUp {
            from {
                opacity: 1;
                transform: translateY(0);
            }
            to {
                opacity: 0;
                transform: translateY(-20px);
            }
        }
    </style>
</head>

<body class="bg-login">
    <!-- Floating Alert (for AJAX responses) -->
    <div id="floatingAlert" class="floating-alert" style="display: none;">
        <div class="alert alert-dismissible fade show" role="alert">
            <span id="alertMessage"></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <!--wrapper-->
    <div class="wrapper">
        <div class="d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                    <div class="col mx-auto">
                        <div class="my-4 text-center">
                            <img src="{{ asset('assets/images/logo-img.png') }}" width="180" alt="Company Logo" class="img-fluid">
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    
                                    @if($errors->any()))
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                            <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    
                                    <div class="text-center">
                                        <h3 class="mb-2">Sign in to your account</h3>
                                        <p class="text-muted">Don't have an account? <a href="{{ route('register.show') }}" class="text-primary">Sign up here</a></p>
                                    </div>
                                    
                                    <div class="d-grid gap-2 my-4">
                                        <a class="btn btn-outline-primary" href="javascript:;">
                                            <i class="fab fa-google me-2"></i> Sign in with Google
                                        </a> 
                                        <a href="javascript:;" class="btn btn-primary">
                                            <i class="fab fa-facebook-f me-2"></i> Sign in with Facebook
                                        </a>
                                    </div>
                                    
                                    <div class="login-separater text-center mb-4">
                                        <span>OR SIGN IN WITH EMAIL</span>
                                        <hr>
                                    </div>
                                    
                                    <div class="form-body">
                                        <form method="POST" action="{{ route('login.store') }}" id="loginForm">
                                            @csrf
                                            
                                            <div class="mb-3">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                    id="inputEmailAddress" name="email" value="{{ old('email') }}" 
                                                    required autocomplete="email" placeholder="example@domain.com">
                                                @error('email')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="inputChoosePassword" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" 
                                                        id="inputChoosePassword" name="password" required 
                                                        autocomplete="current-password" placeholder="••••••••">
                                                    <button class="input-group-text bg-transparent" type="button">
                                                        <i class='bx bx-hide'></i>
                                                    </button>
                                                </div>
                                                @error('password')
                                                <span class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <div class="col-md-6">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                                        <label class="form-check-label" for="remember">Remember Me</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <a href="#">Forgot Password?</a>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary w-100 py-2" id="submitBtn">
                                                    <i class='bx bxs-lock-open me-2'></i> Sign In
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->

    <!-- Bootstrap Bundle with Popper -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    
    <!-- Plugins -->
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    
    <!-- Custom Scripts -->
    <script>
        $(document).ready(function () {
            // Password visibility toggle
            $("#show_hide_password button").on('click', function() {
                const input = $(this).parent().prev();
                const icon = $(this).find('i');
                
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });
            
            // Form submission handler
            $('#loginForm').on('submit', function(e) {
                const submitBtn = $('#submitBtn');
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Signing In...');
            });
            
            // Show floating alert
            function showAlert(message, type) {
                const alert = $('#floatingAlert');
                const alertMessage = $('#alertMessage');
                
                alertMessage.html('<i class="fas ' + 
                    (type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle') + 
                    ' me-2"></i>' + message);
                
                alert.find('.alert')
                    .removeClass('alert-success alert-danger alert-warning alert-info')
                    .addClass('alert-' + type);
                
                alert.fadeIn().delay(3000).fadeOut();
            }
            
            @if(session('status'))
                showAlert("{{ session('status') }}", 'success');
            @endif
        });
    </script>
    
    <!-- App JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>