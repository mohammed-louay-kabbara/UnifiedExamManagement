<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>تسجيل حساب جديد</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-5">

            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center">
                    <h4 class="mb-0">تسجيل حساب جديد</h4>
                </div>

                <div class="card-body p-4">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- الاسم --}}
                        <div class="mb-3">
                            <label class="form-label">الاسم الكامل</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required autofocus>

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- البريد الإلكتروني --}}
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>

                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- رقم الهاتف --}}
                        <div class="mb-3">
                            <label class="form-label">رقم الهاتف</label>
                            <input type="text" name="phone" placeholder="09xxxxxxxx" maxlength="10"
                                pattern="09[0-9]{8}" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" required>

                            <div class="form-text text-muted">
                                يجب أن يتكون رقم الهاتف من 10 أرقام ويبدأ بـ 09
                            </div>

                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">المحافظة </label>
                            <select name="governorate" class="form-control" required>
                                <option value="">اختر محافظة</option>
                                <option value="دمشق">دمشق</option>
                                <option value="ريف دمشق">ريف دمشق</option>
                                <option value="حلب">حلب</option>
                                <option value="حمص">حمص</option>
                                <option value="حماة">حماة</option>
                                <option value="اللاذقية">اللاذقية</option>
                                <option value="طرطوس">طرطوس</option>
                                <option value="إدلب">إدلب</option>
                                <option value="الرقة">الرقة</option>
                                <option value="دير الزور">دير الزور</option>
                                <option value="الحسكة">الحسكة</option>
                                <option value="درعا">درعا</option>
                                <option value="السويداء">السويداء</option>
                                <option value="القنيطرة">القنيطرة</option>
                            </select>

                            @error('governorate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- كلمة المرور --}}
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- تأكيد كلمة المرور --}}
                        <div class="mb-4">
                            <label class="form-label">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation') is-invalid @enderror" required>

                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- زر التسجيل --}}
                        <button type="submit" class="btn btn-success w-100">
                            إنشاء الحساب
                        </button>
                    </form>

                </div>

                <div class="card-footer text-center bg-white">
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        لديك حساب بالفعل؟ تسجيل الدخول
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
