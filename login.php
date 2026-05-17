<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --glass-bg: rgba(255, 255, 255, 0.95);
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-color: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: var(--bg-gradient);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: var(--text-main);
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: var(--glass-bg);
            padding: 50px 40px;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-icon-wrapper {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            background: #eff6ff;
            color: var(--primary);
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .login-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.025em;
            margin-bottom: 10px;
        }

        .login-header p {
            font-size: 0.95rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .input-group {
            margin-bottom: 24px;
        }

        .input-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--text-main);
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            width: 18px;
            height: 18px;
            color: var(--text-muted);
            pointer-events: none;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 16px 12px 48px;
            background: #fff;
            border: 1.5px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.2s ease;
            outline: none;
        }

        .input-wrapper input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 8px;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            margin-top: 32px;
            text-align: center;
        }

        .login-footer a {
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .login-footer a:hover {
            color: var(--primary);
        }

        /* Animasi masuk */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card {
            animation: fadeIn 0.5s ease-out;
        }

        /* Mengatur gaya teks placeholder untuk semua input */
input::placeholder {
    font-style: italic;
    opacity: 0.7; /* Opsional: agar terlihat sedikit lebih samar dan elegan */
    font-size: 0.85rem;
}

    </style>
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon-wrapper">
                    <i data-feather="shield"></i>
                </div>
                <h2>Form Login</h2>
                <p>Silakan masukkan akun Anda</p>
            </div>
            
            <form action="proses_login.php" method="POST">
                <div class="input-group">
                    <label for="username">Username</label>
                    <div class="input-wrapper">
                        <i data-feather="user"></i>
                        <input type="text" name="username" id="username" placeholder="Masukkan username" required autocomplete="off" value="">
                    </div>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i data-feather="key"></i>
                        <input type="password" name="password" id="password" placeholder="Masukkan password" required autocomplete="new-password" value="">
                    </div>
                </div>
<div class="g-recaptcha" data-sitekey="6LfjhuEsAAAAAH6-W8ccjevqilhIjwxkwezxmL_c" style="margin-bottom: 15px;"></div>
                <button type="submit" name="login" class="btn-login">Masuk Sekarang</button>
            </form>
            
            <div class="login-footer">
                <a href="register.php">
                    <i data-feather="user-plus" style="width: 16px;"></i> 
                    register
                </a>
            </div>
        </div>
    </div>

    <script>
        feather.replace();
    </script>
</body>
</html>