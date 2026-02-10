@extends('layouts.admin')
@section('title', 'الدورات الامتحانية')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <!-- Main Content -->
            <main class="flex-fill p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                <form method="GET" action="{{ route('examcycles.search') }}" class="mb-3">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="ابحث عن دورة"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                بحث
                            </button>
                        </div>
                    </div>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    إضافة دورة امتحانية
                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">إضافة دورة امتحانية</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('examcycles.store') }}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">اسم الدورة</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">تاريخ بدء الدورة</label>
                                        <input type="date" name="start_date" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">تاريخ انتهاء الدورة</label>
                                        <input type="date" name="end_date" class="form-control">
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
                            <th>اسم الدورة</th>
                            <th>تاريخ البدء</th>
                            <th>تاريخ الانتهاء</th>
                            <th>الحالة</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse ($exam_cycles as $ex)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $ex->name }}</td>
                                <td>{{ $ex->start_date }}</td>
                                <td>{{ $ex->end_date }}</td>
                                <td>
                                    @if ($ex->start_date <= now() && $ex->end_date > now())
                                        نشطة
                                    @elseif ($ex->start_date > now())
                                        لم تبدأ
                                    @else
                                        منتهية
                                    @endif
                                </td>
                                <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModa{{ $ex->id }}">تعديل</button></td>
                                <td>
                                    <form action="{{ route('examcycles.destroy', $ex->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                                <div class="modal fade" id="exampleModa{{ $ex->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">إضافة دورة </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('examcycles.update', $ex->id) }}" method="post">
                                                @method('PUT')
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">اسم الدورة</label>
                                                        <input type="text" name="name" value="{{ $ex->name }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">تاريخ بدء الدورة</label>
                                                        <input type="date" name="start_date"
                                                            value="{{ $ex->start_date }}" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">تاريخ انتهاء الدورة</label>
                                                        <input type="date" name="end_date"
                                                            value="{{ $ex->end_date }}" class="form-control">
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

</html>
