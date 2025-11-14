<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CarGo - Login</title>

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/adminlte.min.css">

    <style>
        :root {
            --bg-gradient-start: #e8e8e8;
            --bg-gradient-end: #f5f5f5;
            --card-bg: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --text-muted: #999999;
            --border-color: #e0e0e0;
            --input-bg: #ffffff;
            --icon-color: #999999;
        }

        [data-theme="dark"] {
            --bg-gradient-start: #1a202c;
            --bg-gradient-end: #2d3748;
            --card-bg: #2d3748;
            --text-primary: #f7fafc;
            --text-secondary: #e2e8f0;
            --text-muted: #a0aec0;
            --border-color: #4a5568;
            --input-bg: #1a202c;
            --icon-color: #cbd5e0;
        }

        body {
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Source Sans Pro', sans-serif;
            transition: background 0.3s ease;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
            transition: background-color 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #5e9be6ff 0%, #90c6edff 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }

        .login-header i {
            font-size: 3.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .login-header h2 {
            margin: 0;
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .login-header p {
            margin: 8px 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }

        .login-body {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            font-size: 0.9rem;
            display: block;
            transition: color 0.3s ease;
        }

        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background-color: var(--input-bg);
            color: var(--text-primary);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            background-color: var(--input-bg);
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--icon-color);
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .input-icon .form-control {
            padding-right: 45px;
        }

        .btn-login {
            background: linear-gradient(135deg, #5e9be6ff 0%, #90c6edff 100%);
            border: none;
            border-radius: 8px;
            padding: 14px;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: var(--border-color);
            transition: background 0.3s ease;
        }

        .divider span {
            background: var(--card-bg);
            padding: 0 15px;
            position: relative;
            color: var(--text-muted);
            font-size: 0.85rem;
            transition: all 0.3s ease;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
            color: var(--text-secondary);
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .register-link a {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .register-link a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            border-radius: 8px;
            border: none;
            padding: 12px 15px;
            margin-bottom: 20px;
        }

        .back-to-site {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-site a {
            color: var(--text-primary);
            text-decoration: none;
            font-size: 0.9rem;
            opacity: 0.9;
            transition: all 0.3s ease;
        }

        .back-to-site a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        .back-to-site i {
            margin-right: 5px;
        }

        /* Dark mode specific overrides */
        [data-theme="dark"] .login-card {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        }

        [data-theme="dark"] .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        [data-theme="dark"] .alert-danger {
            background-color: rgba(245, 101, 101, 0.2);
            color: #fc8181;
        }
    </style>

    <script>
        // Initialize theme from localStorage
        (function() {
            const storedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', storedTheme);
        })();
    </script>
</head>

<body>
    @include('sweetalert::alert')

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="fas fa-car"></i>
                <h2>Welcome Back</h2>
                <p>Sign in to continue to CarGo</p>
            </div>

            <div class="login-body">
                <form action="{{route('loginCheck')}}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <div class="input-icon">
                            <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            <i class="fas fa-envelope"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="input-icon">
                            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                            <i class="fas fa-lock"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                    </button>
                </form>

                <div class="divider">
                    <span>OR</span>
                </div>

                <div class="register-link">
                    Don't have an account? <a href="/register">Create one now</a>
                </div>
            </div>
        </div>

        <div class="back-to-site">
            <a href="/">
                <i class="fas fa-arrow-left"></i> Back to Homepage
            </a>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/admin/dist/js/adminlte.min.js"></script>
</body>

</html>