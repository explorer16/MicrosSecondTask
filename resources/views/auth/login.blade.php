<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в систему</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card shadow-lg" style="width: 400px;">
    <div class="card-body">
        <h4 class="text-center mb-4">Вход в систему</h4>

        @if (session('status'))
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="loginForm">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email адрес</label>
                <input type="email" name="email" id="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" name="password" id="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label class="form-check-label" for="remember">Запомнить меня</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Войти</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('register') }}">Создать аккаунт</a>
        </div>

        <div id="alertBox" class="alert d-none mt-3"></div>
    </div>
</div>
<script>
    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const alertBox = document.getElementById('alertBox');
        const csrfToken = document.querySelector('input[name="_token"]').value;

        let valid = true;
        if (!email || !email.includes('@')) { markInvalid(emailInput); valid = false; }
        if (password.length < 6) { markInvalid(passwordInput); valid = false; }

        if (!valid) return;

        try {
            const res = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ email, password })
            });

            const data = await res.json();

            if (res.ok && data.token) {
                alertBox.className = 'alert alert-success mt-3';
                alertBox.textContent = 'Вход выполнен успешно!';
                localStorage.setItem('access_token', data.token);
            } else {
                alertBox.className = 'alert alert-danger mt-3';
                alertBox.textContent = data.message || 'Неверные учетные данные.';
            }
            alertBox.classList.remove('d-none');
        } catch (error) {
            alertBox.className = 'alert alert-danger mt-3';
            alertBox.textContent = 'Ошибка соединения с сервером.';
            alertBox.classList.remove('d-none');
        }
    });

    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    function markInvalid(input) {
        input.classList.add('is-invalid');
        setTimeout(() => input.classList.remove('is-invalid'), 2000);
    }
</script>
</body>
</html>
