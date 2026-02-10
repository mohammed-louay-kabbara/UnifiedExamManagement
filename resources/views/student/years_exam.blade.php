@extends('layouts.students')
@section('title', 'البرنامج الامتحاني')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <main class="flex-fill p-4">

                <h2>الامتحان</h2>
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> السنة</th>
                            <th>تاريخ الامتحان</th>
                            <th>وقت البدء</th>
                            <th>وقت الانتهاء</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            use Carbon\Carbon;

                            $now = Carbon::now(); // الآن بتوقيت سوريا
                            $i = 1;
                        @endphp

                        @foreach ($exam as $ex)
                            @php
                                $examEnd = Carbon::parse($ex->exam_date . ' ' . $ex->end_time);
                            @endphp

                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $ex->examCycle->name }}</td>
                                <td>{{ $ex->exam_date }}</td>
                                <td>{{ $ex->start_time }}</td>
                                <td>{{ $ex->end_time }}</td>

                                <td>
                                    {{-- يظهر الزر فقط قبل وقت النهاية --}}
                                    @if ($now->lt($examEnd))
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#examPasswordModal{{ $ex->id }}">
                                            ابدأ الامتحان
                                        </button>
                                    @else
                                        <span class="badge bg-danger">
                                            انتهى وقت الامتحان
                                        </span>
                                    @endif
                                </td>
                                <div class="modal fade" id="examPasswordModal{{ $ex->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">تنبيه قبل بدء الامتحان</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form action="{{ route('student.exam.verify') }}" method="get">
                                                @csrf

                                                <div class="modal-body">
                                                    <input type="hidden" name="exam_id" value="{{ $ex->id }}">

                                                    <div class="alert alert-warning">
                                                        الرجاء إدخال كلمة السر للبدء بالامتحان
                                                        <br>
                                                        <small>لا يمكنك العودة بعد البدء</small>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">كلمة السر</label>
                                                        <input type="text" name="exam_code" class="form-control"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        إلغاء
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        دخول الامتحان
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </main>
        </div>
    @endsection
</body>
