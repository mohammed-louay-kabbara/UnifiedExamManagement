@extends('layouts.admin')
@section('title', 'تقارير')

<body class="bg-light">
    @section('content')
        <div>
            <form class="d-flex gap-2" action="{{ route('report_admin_view') }}" method="get">

                <select class="form-control mb-3" name="exam_cycle_id" required>
                    <option value="">اختر الدورة الامتحانية</option>
                    @foreach ($exam_cycles as $cycle)
                        <option value="{{ $cycle->id }}" {{ request('exam_cycle_id') == $cycle->id ? 'selected' : '' }}>
                            {{ $cycle->name }}
                        </option>
                    @endforeach
                </select>

                <button class="btn btn-primary mb-3">عرض</button>
            </form>

        </div>


        @if ($report_exam)
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الطالب</th>
                        <th>العلامة</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($report_exam as $index => $res)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $res->student->name }}</td>
                            <td>{{ $res->score }}</td>
                            <td>
                                @if ($res->score >= 60)
                                    <span class="badge bg-success">ناجح</span>
                                @else
                                    <span class="badge bg-danger">راسب</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
        @endif

    @endsection

</body>
