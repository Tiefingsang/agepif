<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Connexion Admin - AGEPIF</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            background: #1a2a3a;
            color: white;
            padding: 30px;
            text-align: center;
        }

        .login-header h3 {
            margin: 0;
            font-size: 24px;
        }

        .login-header p {
            margin: 10px 0 0;
            opacity: 0.8;
            font-size: 14px;
        }

        .login-body {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.25);
        }

        .btn-login {
            background: #1a2a3a;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            color: white;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background: #2c3e50;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .text-muted {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h3><i class="fas fa-building"></i> AGEPIF ADMIN</h3>
            <p>Administration du site immobilier</p>
        </div>

        <div class="login-body">
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <i class="fas fa-exclamation-circle"></i> {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </button>
            </form>

            <div class="text-muted">
                <small>Email: admin@agepif.com | Mot de passe: admin123</small>
            </div>
        </div>
    </div>
</body>
</html>
