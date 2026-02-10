@extends('layouts.students')
@section('title', 'بنك الأسئلة')

<body class="bg-light">
    @section('content')
        <div class="">
            @foreach ($questions as $q)
                <div class="card mb-3">
                    <div class="card-body">
                        @if ($q->type=="text")
                            <h6>{{ $q->question }}</h6>
                            @else
                            <img src="{{ asset('storage/' . $q->question) }}" class="form-control mb-3" alt="">
                        @endif
                        

                        @foreach ($q->options as $opt)
                            <div class="{{ $opt->is_correct ? 'text-success fw-bold' : '' }}">
                                <input type="radio" disabled {{ $opt->is_correct ? 'checked' : '' }}>
                                {{ $opt->option_text }}

                                @if ($opt->is_correct)
                                    <span class="badge bg-success ms-2">✔ الجواب الصحيح</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    @endsection

</body>
