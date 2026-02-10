@extends('layouts.professors')
@section('title', 'الأسئلة')

<body class="bg-light">
    @section('content')
        <div class="">
            <h2>يرجى اختيار السنة </h2> <br>
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
                            <td>
                                <a href="{{ route('questions.show',$ex->year_id ) }}">
                                {{ $ex->year->name }}
                                </a>
                            </td>
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
