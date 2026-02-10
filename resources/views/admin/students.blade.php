@extends('layouts.admin')
@section('title', 'إدارة الطلاب')

<body class="bg-light">
    @section('content')
    <div class="d-flex">
            <main class="flex-fill p-4">
                <form method="GET" action="{{ route('students.search') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="ابحث باسم الطالب"
                                value="{{ request('search') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                بحث
                            </button>
                        </div>
                    </div>
                </form>
                <form method="GET" action="{{ route('students.year') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="year" class="form-control"
                                placeholder="ضع فقط رقم السنة مثل 2025" value="{{ request('year') }}">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">
                                فرز حسب التاريخ الانتساب
                            </button>
                            <a href="{{ route('student.index') }}" type="submit" class="btn btn-secondary">
                                عرض الكل
                            </a>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>اسم</th>
                            <th>إيميل</th>
                            <th>رقم الهاتف</th>
                            <th>حالة الطالب</th>
                            <th>تاريخ الانتساب</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse ($students as $st)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $st->name }}</td>
                                <td>{{ $st->email }}</td>
                                <td>{{ $st->phone }}</td>
                                <td>{{ $st->status }}</td>
                                <td>{{ $st->created_at->format('Y-m-d') }}</td>
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
