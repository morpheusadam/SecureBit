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
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Page Title -->
    <title>Register | Management System</title>
    
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
        
        .password-strength {
            height: 5px;
            margin-top: 5px;
            border-radius: 2.5px;
            transition: var(--transition);
        }
        
        .password-strength.weak {
            background-color: var(--danger-color);
            width: 25%;
        }
        
        .password-strength.medium {
            background-color: #f59e0b;
            width: 50%;
        }
        
        .password-strength.strong {
            background-color: var(--success-color);
            width: 100%;
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
        
        .progress-bar-animated {
            animation: progress-bar-stripes 1s linear infinite;
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
                        <div class="my-4 text-center animate__animated animate__fadeIn">
                            <img src="{{ asset('assets/images/logo-img.png') }}" width="180" alt="Company Logo" class="img-fluid">
                        </div>
                        <div class="card animate__animated animate__fadeInUp">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    @if(session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX">
                                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    
                                    @if($errors->any()))
                                    <div class="alert alert-danger alert-dismissible fade show animate__animated animate__shakeX">
                                        <ul class="mb-0">
                                            @foreach($errors->all() as $error)
                                            <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    
                                    @if(session('success'))
                                    <div class="alert alert-success animate__animated animate__fadeIn">
                                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                                        <div class="progress mt-2">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 100%"></div>
                                        </div>
                                    </div>
                                    <script>
                                        setTimeout(function() {
                                            window.location.href = "{{ route('home') }}";
                                        }, 3000);
                                    </script>
                                    @else
                                    <div class="text-center">
                                        <h3 class="mb-2">Create New Account</h3>
                                        <p class="text-muted">Already have an account? <a href="{{ route('login.show') }}" class="text-primary">Sign in here</a></p>
                                    </div>
                                    
                                    <div class="d-grid gap-2 my-4">
                                        <a class="btn btn-outline-primary" href="javascript:;">
                                            <i class="fab fa-google me-2"></i> Sign up with Google
                                        </a> 
                                        <a href="javascript:;" class="btn btn-primary">
                                            <i class="fab fa-facebook-f me-2"></i> Sign up with Facebook
                                        </a>
                                    </div>
                                    
                                    <div class="login-separater text-center mb-4">
                                        <span>OR REGISTER WITH EMAIL</span>
                                        <hr>
                                    </div>
                                    
                                    <div class="form-body">
                                        <form method="POST" action="{{ route('register.store') }}" id="registerForm" class="needs-validation" novalidate>
                                            @csrf
                                            
                                            <div class="mb-3">
                                                <label for="full_name" class="form-label">Full Name</label>
                                                <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                                    id="full_name" name="full_name" value="{{ old('full_name') }}" 
                                                    required autocomplete="name" autofocus placeholder="John Doe">
                                                <div class="invalid-feedback">
                                                    Please enter your full name
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                                    id="username" name="username" value="{{ old('username') }}" 
                                                    required autocomplete="username" placeholder="johndoe">
                                                <div class="invalid-feedback">
                                                    Please choose a username
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email Address</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                    id="email" name="email" value="{{ old('email') }}" 
                                                    required autocomplete="email" placeholder="example@domain.com">
                                                <div class="invalid-feedback">
                                                    Please enter a valid email address
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0 @error('password') is-invalid @enderror" 
                                                        id="password" name="password" required autocomplete="new-password" 
                                                        placeholder="••••••••" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                                                    <button class="input-group-text bg-transparent" type="button">
                                                        <i class='bx bx-hide'></i>
                                                    </button>
                                                </div>
                                                <div id="passwordStrength" class="password-strength mt-1"></div>
                                                <small class="text-muted">Minimum 8 characters with at least one uppercase, one lowercase, and one number</small>
                                                <div class="invalid-feedback">
                                                    Password must be at least 8 characters with uppercase, lowercase and number
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="password-confirm" class="form-label">Confirm Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" 
                                                        id="password-confirm" name="password_confirmation" 
                                                        required autocomplete="new-password" placeholder="••••••••">
                                                    <button class="input-group-text bg-transparent" type="button">
                                                        <i class='bx bx-hide'></i>
                                                    </button>
                                                </div>
                                                <div id="passwordMatch" class="text-small mt-1"></div>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <div class="form-check">
                                                    <input class="form-check-input @error('terms') is-invalid @enderror" 
                                                        type="checkbox" id="terms" name="terms" required>
                                                    <label class="form-check-label" for="terms">
                                                        I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms & Conditions</a>
                                                    </label>
                                                    <div class="invalid-feedback">
                                                        You must agree to the terms and conditions
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-primary w-100 py-2" id="submitBtn">
                                                    <i class='bx bx-user me-2'></i> Register
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end wrapper-->
    
    <!-- Terms Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Terms & Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>1. General Terms</h6>
                    <p>By accessing and using this service, you accept and agree to be bound by the terms and provisions of this agreement.</p>
                    
                    <h6>2. Privacy Policy</h6>
                    <p>We respect your privacy and are committed to protecting your personal data in accordance with applicable data protection laws.</p>
                    
                    <h6>3. User Responsibilities</h6>
                    <p>You agree not to use the service for any unlawful purpose or in any way that might harm, damage, or disparage any other party.</p>
                    
                    <h6>4. Account Security</h6>
                    <p>You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

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
            $("[data-toggle='password']").on('click', function() {
                const input = $(this).prev();
                const icon = $(this).find('i');
                
                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('bx-hide').addClass('bx-show');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('bx-show').addClass('bx-hide');
                }
            });
            
            // Password strength indicator
            $('#password').on('keyup', function() {
                const password = $(this).val();
                const strengthBar = $('#passwordStrength');
                
                // Reset
                strengthBar.removeClass('weak medium strong').width('0%');
                
                if (password.length > 0) {
                    // Calculate strength
                    let strength = 0;
                    
                    // Length
                    if (password.length > 7) strength += 1;
                    
                    // Contains numbers
                    if (password.match(/\d/)) strength += 1;
                    
                    // Contains lowercase
                    if (password.match(/[a-z]/)) strength += 1;
                    
                    // Contains uppercase
                    if (password.match(/[A-Z]/)) strength += 1;
                    
                    // Contains special chars
                    if (password.match(/[^a-zA-Z0-9]/)) strength += 1;
                    
                    // Update strength bar
                    if (strength < 2) {
                        strengthBar.addClass('weak').width('25%');
                    } else if (strength < 4) {
                        strengthBar.addClass('medium').width('50%');
                    } else {
                        strengthBar.addClass('strong').width('100%');
                    }
                }
            });
            
            // Password match verification
            $('#password-confirm').on('keyup', function() {
                const password = $('#password').val();
                const confirmPassword = $(this).val();
                const matchIndicator = $('#passwordMatch');
                
                if (confirmPassword.length === 0) {
                    matchIndicator.text('').removeClass('text-danger text-success');
                } else if (password !== confirmPassword) {
                    matchIndicator.text('Passwords do not match').addClass('text-danger').removeClass('text-success');
                } else {
                    matchIndicator.text('Passwords match').addClass('text-success').removeClass('text-danger');
                }
            });
            
            // Form validation
            $('#registerForm').on('submit', function(e) {
                const form = $(this);
                const submitBtn = $('#submitBtn');
                
                if (form[0].checkValidity() === false) {
                    e.preventDefault();
                    e.stopPropagation();
                } else {
                    submitBtn.prop('disabled', true);
                    submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i> Processing...');
                }
                
                form.addClass('was-validated');
            });
            
            // Username availability check (AJAX)
            $('#username').on('blur', function() {
                const username = $(this).val();
                const feedback = $(this).next('.invalid-feedback');
                
                if (username.length > 3) {
                    $.ajax({
                        url: '/check-username',
                        method: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            username: username
                        },
                        success: function(response) {
                            if (response.available) {
                                showAlert('Username is available!', 'success');
                            } else {
                                feedback.text('Username is already taken');
                                $('#username').addClass('is-invalid');
                                showAlert('Username is already taken', 'danger');
                            }
                        }
                    });
                }
            });
            
            // Email availability check (AJAX)
            $('#email').on('blur', function() {
                const email = $(this).val();
                const feedback = $(this).next('.invalid-feedback');
                
                if (email.length > 5 && email.includes('@')) {
                    $.ajax({
                        url: '/check-email',
                        method: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            email: email
                        },
                        success: function(response) {
                            if (response.available) {
                                showAlert('Email is available!', 'success');
                            } else {
                                feedback.text('Email is already registered');
                                $('#email').addClass('is-invalid');
                                showAlert('Email is already registered', 'danger');
                            }
                        }
                    });
                }
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
        });
    </script>
    
    <!-- App JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>