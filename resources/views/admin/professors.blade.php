@extends('layouts.admin')
@section('title', 'إدارة المدرسين')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <!-- Main Content -->
            <main class="flex-fill p-4">
                <form method="GET" action="{{ route('professor.search') }}" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                بحث
                            </button>
                        </div>
                    </div>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    إضافة دكتور
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">إضافة دكتور</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('professor.store') }}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">الاسم</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">الإيميل </label>
                                        <input type="email" name="email" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">رقم الهاتف</label>
                                        <input type="text" name="phone" placeholder="09xxxxxxxx" maxlength="10"
                                            pattern="09[0-9]{8}" class="form-control @error('phone') is-invalid @enderror"
                                            value="{{ old('phone') }}" required>

                                        <div class="form-text text-muted">
                                            يجب أن يتكون رقم الهاتف من 10 أرقام ويبدأ بـ 09
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">كلمة السر</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم </th>
                            <th>الايميل</th>
                            <th>رقم الهاتف</th>
                            <th>تاريخ الانتساب</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse ($professors as $p)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->email }}</td>
                                <td>{{ $p->phone }}</td>
                                <td>{{ $p->created_at->format('Y-m-d') }}</td>
                                <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModa{{ $p->id }}">تعديل</button></td>
                                <td>
                                    <form action="{{ route('professor.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                                <div class="modal fade" id="exampleModa{{ $p->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">تعديل معلومات الأستاذ </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('professor.update', $p->id) }}" method="post">
                                                <div class="modal-body">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">الاسم</label>
                                                        <input type="text" name="name" value="{{ $p->name }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">الإيميل </label>
                                                        <input type="email" name="email" value="{{ $p->email }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">رقم الهاتف </label>
                                                        <input type="text" name="phone" value="{{ $p->phone }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">كلمة السر جديدة</label>
                                                        <input type="password" name="newpassword" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    لا يوجد نتائج
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </main>
        </div>
    @endsection
</body>
