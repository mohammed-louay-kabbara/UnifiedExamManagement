<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4">

        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">تسجيل الدخول</h4>
            </div>

            <div class="card-body p-4">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- البريد الإلكتروني --}}
                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email"
                               name="email"
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               required autofocus>

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- كلمة المرور --}}
                    <div class="mb-3">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password"
                               name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- زر الدخول --}}
                    <button type="submit" class="btn btn-primary w-100">
                        تسجيل الدخول
                    </button>
                </form>

            </div>

            <div class="card-footer text-center bg-white">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-decoration-none">
                        إنشاء حساب جديد
                    </a>
                @endif
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
