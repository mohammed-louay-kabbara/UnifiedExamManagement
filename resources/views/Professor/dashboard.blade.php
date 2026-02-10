@extends('layouts.professors')
@section('title', 'لوحة الأستاذ')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <!-- Main Content -->
            <main class="flex-fill p-4">
                <!-- Statistics -->
                <div class="row g-4 mb-4">
                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h6 class="text-muted">عدد السنوات التي يدرسها</h6>
                                <h2 class="fw-bold">{{ $years_count }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h6 class="text-muted">عدد الأسئلة الذي أضفتها</h6>
                                <h2 class="fw-bold">{{ $questions }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <h2>السنوات المكلف بتدريسها</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> السنة</th>
                  
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse ($years as $ex)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $ex->year->name }}</td>
                                
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
