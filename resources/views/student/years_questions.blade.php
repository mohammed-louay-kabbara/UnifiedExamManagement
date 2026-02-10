@extends('layouts.students')
@section('title', 'السنوات')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <main class="flex-fill p-4">

                <h2>السنوات</h2>
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
                                    <a href="{{ route('student.training',$ex->id) }}">
                                        {{ $ex->name }}
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
