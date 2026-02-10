@extends('layouts.students')
@section('title', 'الصفحة الرئيسية')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <main class="flex-fill p-4">

                <h2>السنوات</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> الدورة</th>
                            <th>العلامة</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exams as $e )
                        @php $i=1; @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $e->exam->exam_cycle->name }}</td>

                                @if ($e->score)
                                    <td>{{ $e->score }}</td>
                                    <td>
                                        @if ($e->score >=50)
                                            <span class="badge bg-success">ناجح</span>
                                        @else
                                            <span class="badge bg-danger">راسب</span>
                                        @endif
                                    </td>
                                @else
                                    <td colspan="2" class="text-muted text-center">
                                        لم يتم التقديم
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </main>
        </div>

    @endsection

</body>
