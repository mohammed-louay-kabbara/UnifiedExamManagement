<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
@extends('layouts.admin')
@section('title', 'البرنامج الامتحاني')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <main class=" p-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    إضافة موعد امتحاني
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">إضافة موعد امتحاني</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('ExamSchedules.store') }}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="">اسم الدورة</label>
                                        <select name="exam_cycle_id" class="form-control mb-3 select2" required>
                                            <option value=""></option>
                                            @foreach ($exam_cycles as $exam_cycle)
                                                <option value="{{ $exam_cycle->id }}">
                                                    {{ $exam_cycle->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">تاريخ الامتحان</label>
                                        <input type="date" name="exam_date" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">وقت بدء الامتحان</label>
                                        <input type="time" name="start_time" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">وقت انتهاء الامتحان</label>
                                        <input type="time" name="end_time" class="form-control">
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
                            <th>الدورة</th>
                            <th>تاريخ الامتحان</th>
                            <th>وقت بدء الامتحان</th>
                            <th>وقت انتهاء الامتحان</th>
                            <th>كود الدخول</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse ($exam_schedules as $ex)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $ex->examCycle->name }}</td>
                                <td>{{ $ex->exam_date }}</td>
                                <td>{{ $ex->start_time }}</td>
                                <td>{{ $ex->end_time }}</td>
                                <td>{{ $ex->code }}</td>
                                <td>
                                    <form action="{{ route('exam_student_centers.store') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="exam_schedule_id" value="{{ $ex->id }}">
                                        <button type="submit" class="btn btn-primary">توزيع اطلاب على المراكز</button>
                                    </form>
                                </td>
                                <td>
                                <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModa{{ $ex->id }}">تعديل</button></td>
                                <td>
                                    <form action="{{ route('ExamSchedules.destroy', $ex->id) }}" method="POST"
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
                                                <h5 class="modal-title" id="exampleModalLabel">إضافة برنامج امتحاني</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('ExamSchedules.update', $ex->id) }}" method="post">
                                                @method('PUT')
                                                <div class="modal-body">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="">اسم الدورة</label>
                                                        <select name="exam_cycle_id" class="form-control mb-3 select2"
                                                            required>
                                                            <option value="{{ $ex->examCycle->id }}">
                                                                {{ $ex->examCycle->name }}</option>
                                                            @foreach ($exam_cycles as $exam_cycle)
                                                                <option value="{{ $exam_cycle->id }}">
                                                                    {{ $exam_cycle->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">تاريخ الامتحان</label>
                                                        <input type="date" name="exam_date" value="{{ $ex->exam_date }}"
                                                            class="form-control">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">وقت بدء الامتحان</label>
                                                        <input type="time" name="start_time"
                                                            value="{{ $ex->start_time }}" class="form-control">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">وقت انتهاء الامتحان</label>
                                                        <input type="time" name="end_time"
                                                            value="{{ $ex->end_time }}" class="form-control">
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            // select2 داخل مودال الإضافة
            $('#exampleModal .select2').select2({
                dropdownParent: $('#exampleModal'),
                placeholder: "اختر",
                allowClear: true,
                width: '100%'
            });

            // select2 داخل مودالات التعديل
            $('[id^="exampleModa"]').each(function() {
                $(this).find('.select2').select2({
                    dropdownParent: $(this),
                    placeholder: "اختر",
                    allowClear: true,
                    width: '100%'
                });
            });

        });
    </script>
</body>

</html>
