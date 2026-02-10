<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
@extends('layouts.admin')
@section('title', 'تكليف الدكاترة ')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <main class=" p-4">
                <form action="{{ route('Professoryear.store') }}" method="POST">
                    @csrf
                    <label for="">اسم الدورة</label>
                    <select name="exam_cycle_id" class="form-control mb-3 select2" required>
                        <option value=""></option>
                        @foreach ($exam_cycles as $exam_cycle)
                            <option value="{{ $exam_cycle->id }}">
                                {{ $exam_cycle->name }}
                            </option>
                        @endforeach
                    </select>
                    <br> <br>
                    <label for="">اسم الدكتور</label>
                    <select name="professor_id" class="form-control mb-3 select2" required>
                        <option value=""></option>
                        @foreach ($professors as $professor)
                            <option value="{{ $professor->id }}">
                                {{ $professor->name }}
                            </option>
                        @endforeach
                    </select>
                    @foreach ($years as $year)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="years[]" value="{{ $year->id }}"
                                id="sub{{ $year->id }}">
                            <label class="form-check-label" for="sub{{ $year->id }}">
                                {{ $year->name }}
                            </label>
                        </div>
                    @endforeach

                    <button class="btn btn-primary mt-3">
                        حفظ التكليف
                    </button>
                </form>
            </main>
        </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "اختر",
                allowClear: true
            });
        });
    </script>
</body>

</html>
