@extends('layouts.admin')
@section('title', 'لوحة التحكم')
<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <main class="flex-fill p-4">
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h6 class="text-muted">عدد الطلاب</h6>
                                <h2 class="fw-bold">{{ $students }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h6 class="text-muted">عدد المدرسين</h6>
                                <h2 class="fw-bold">{{ $professors }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h6 class="text-muted">الدورات</h6>
                                <h2 class="fw-bold">{{ $exam_cycles }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h6 class="text-muted">عدد المراكز</h6>
                                <h2 class="fw-bold">{{ $exam_centers }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    @endsection

</body>
