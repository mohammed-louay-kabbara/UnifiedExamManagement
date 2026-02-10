<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>امتحان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    



<form action="{{ route('student.exam.submit') }}" method="POST">
@csrf

<input type="hidden" name="exam_id" value="{{ $exam->id }}">

@foreach ($exam->questions as $q)
    <div class="card mb-3">
        <div class="card-body">
            <h6>
                @if ($q->type=="text")
                {{ $q->question }}</h6>
                    @else
                    <img src="{{ asset('storage/' . $q->question ) }}" width="600px" alt="">
                @endif
            @foreach ($q->options as $opt)
                <div class="form-check">
                    <input class="form-check-input"
                           type="radio"
                           name="answers[{{ $q->id }}]"
                           value="{{ $opt->id }}"
                           required>
                    <label class="form-check-label">
                        {{ $opt->option_text }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<button class="btn btn-danger w-100">
    إنهاء الامتحان
</button>

</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

