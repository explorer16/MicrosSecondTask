{{-- resources/views/auth/register.blade.php --}}
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация — API Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 15px;
        }
        .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Регистрация пользователя</h4>
                </div>
                <div class="card-body p-4">
                    <form id="registerForm" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="name" required>
                            <div class="invalid-feedback">Введите имя</div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                            <div class="invalid-feedback">Введите корректный email</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="password" required minlength="6">
                            <div class="invalid-feedback">Минимум 6 символов</div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Подтверждение пароля</label>
                            <input type="password" class="form-control" id="password_confirmation" required>
                            <div class="invalid-feedback">Пароли должны совпадать</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                    </form>

                    <div id="alertBox" class="alert mt-3 d-none" role="alert"></div>

                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">Уже зарегистрированы?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('registerForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const name = nameInput.value.trim();
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        const password_confirmation = passwordConfirmInput.value;
        const alertBox = document.getElementById('alertBox');
        const csrfToken = document.querySelector('input[name="_token"]').value;

        let valid = true;
        if (!name) { markInvalid(nameInput); valid = false; }
        if (!email || !email.includes('@')) { markInvalid(emailInput); valid = false; }
        if (password.length < 6) { markInvalid(passwordInput); valid = false; }
        if (password !== password_confirmation) { markInvalid(passwordConfirmInput); valid = false; }

        if (!valid) return;

        try {
            const res = await fetch('/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ name, email, password, password_confirmation })
            });

            const data = await res.json();

            if (res.ok) {
                alertBox.className = 'alert alert-success mt-3';
                alertBox.textContent = 'Регистрация успешна! Токен получен.';
                localStorage.setItem('access_token', data.token); // сохраняем токен Passport
            } else {
                alertBox.className = 'alert alert-danger mt-3';
                alertBox.textContent = data.message || 'Ошибка при регистрации.';
            }
            alertBox.classList.remove('d-none');
        } catch (error) {
            alertBox.className = 'alert alert-danger mt-3';
            alertBox.textContent = 'Ошибка соединения с сервером.';
            alertBox.classList.remove('d-none');
        }
    });

    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const passwordConfirmInput = document.getElementById('password_confirmation');

    function markInvalid(input) {
        input.classList.add('is-invalid');
        setTimeout(() => input.classList.remove('is-invalid'), 2000);
    }
</script>

</body>
</html>
