@extends('layouts.admin')
@section('title', 'إدارة السنوات الدراسية')

<body class="bg-light">
    @section('content')
        <div class="d-flex">
            <main class="flex-fill p-4">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    إضافة سنة
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">إضافة سنة</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('year.store') }}" method="post">
                                <div class="modal-body">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">السنة </label>
                                        <input type="text" name="name" class="form-control">
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
                            <th>السنة</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse ($years as $su)
                            <tr>
                                <th>{{ $i++ }}</th>
                                <td>{{ $su->name }}</td>
                                <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#exampleModa{{ $su->id }}">تعديل</button></td>
                                <td>
                                    <form action="{{ route('year.destroy', $su->id) }}" method="POST"
                                        onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            حذف
                                        </button>
                                    </form>
                                </td>
                                <div class="modal fade" id="exampleModa{{ $su->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">تعديل سنة</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('year.update', $su->id) }}" method="post">
                                                <div class="modal-body">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label class="form-label">السنة</label>
                                                        <input type="text" name="name" class="form-control"
                                                            value="{{ $su->name }}">
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
</body>

</html>
