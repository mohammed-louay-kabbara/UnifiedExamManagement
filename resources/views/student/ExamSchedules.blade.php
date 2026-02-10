@extends('layouts.students')
@section('title', 'برنامج الامتحان')

<body class="bg-light">
    @section('content')


        @if ($exam_schedules)
            <table class="table">
                <tr>
                    <th>#</th>
                    <th> السنة</th>
                    <th>تاريخ الامتحان</th>
                    <th>وقت بدء الامتحان</th>
                    <th>وقت انتهاء الامتحان</th>
                    <th>اسم المركز</th>
                </tr>
                @php $i = 1; @endphp
                @foreach ($exam_schedules as $ex)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $ex->exam_schedule->examCycle->name }}</td>
                        <td>{{ $ex->exam_schedule->exam_date }}</td>
                        <td>{{ $ex->exam_schedule->start_time }}</td>
                        <td>{{ $ex->exam_schedule->end_time }}</td>
                        <td>{{ $ex->exam_center->name }}</td>
                    </tr>
                @endforeach
            </table>
        @endif
    @endsection

</body>
