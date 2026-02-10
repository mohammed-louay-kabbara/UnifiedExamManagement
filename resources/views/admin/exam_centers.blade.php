@extends('layouts.admin')
@section('title', 'المراكز الامتحانية')

<body class="bg-light">
    @section('content')
        <div class="">

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                إضافة مركز امتحانية
            </button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة دورة امتحانية</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('examcenters.store') }}" method="post">
                            <div class="modal-body">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">اسم المركز</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">موقع المركز</label>
                                    <select name="governorate" class="form-control" required>
                                        <option value="">اختر المحافظة</option>
                                        <option value="دمشق">دمشق</option>
                                        <option value="ريف دمشق">ريف دمشق</option>
                                        <option value="حلب">حلب</option>
                                        <option value="حمص">حمص</option>
                                        <option value="حماة">حماة</option>
                                        <option value="اللاذقية">اللاذقية</option>
                                        <option value="طرطوس">طرطوس</option>
                                        <option value="إدلب">إدلب</option>
                                        <option value="الرقة">الرقة</option>
                                        <option value="دير الزور">دير الزور</option>
                                        <option value="الحسكة">الحسكة</option>
                                        <option value="درعا">درعا</option>
                                        <option value="السويداء">السويداء</option>
                                        <option value="القنيطرة">القنيطرة</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">مكان المركز بالتفصيل</label>
                                    <input type="text" name="location" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"> استطاعة المركز</label>
                                    <input type="number" name="amount" class="form-control">
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
                        <th>اسم المركز</th>
                        <th>مكان المركز</th>
                        <th>المكان بالتفصيل</th>
                        <th>الاستطاعة</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse ($exam_centers as $ex)
                        <tr>
                            <th>{{ $i++ }}</th>
                            <td>{{ $ex->name }}</td>
                            <td>{{ $ex->governorate }}</td>
                            <td>{{ $ex->location }}</td>
                            <td>{{ $ex->amount }}</td>
                            <td><button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModa{{ $ex->id }}">تعديل</button></td>
                            <td>
                                <form action="{{ route('examcenters.destroy', $ex->id) }}" method="POST"
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
                                            <h5 class="modal-title" id="exampleModalLabel">إضافة مركز</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('examcenters.update', $ex->id) }}" method="post">
                                            @method('PUT')
                                            <div class="modal-body">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label">اسم المركز</label>
                                                    <input type="text" name="name" value="{{ $ex->name }}"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">موقع المركز</label>
                                                    <select name="governorate" class="form-control" required>
                                                        <option value="{{ $ex->governorate }}"> {{ $ex->governorate }}
                                                        </option>
                                                        <option value="دمشق">دمشق</option>
                                                        <option value="ريف دمشق">ريف دمشق</option>
                                                        <option value="حلب">حلب</option>
                                                        <option value="حمص">حمص</option>
                                                        <option value="حماة">حماة</option>
                                                        <option value="اللاذقية">اللاذقية</option>
                                                        <option value="طرطوس">طرطوس</option>
                                                        <option value="إدلب">إدلب</option>
                                                        <option value="الرقة">الرقة</option>
                                                        <option value="دير الزور">دير الزور</option>
                                                        <option value="الحسكة">الحسكة</option>
                                                        <option value="درعا">درعا</option>
                                                        <option value="السويداء">السويداء</option>
                                                        <option value="القنيطرة">القنيطرة</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">الموقع بالتفصيل</label>
                                                    <input type="text" name="location" value="{{ $ex->location }}"
                                                        class="form-control">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label"> استطاعة المركز</label>
                                                    <input type="number" name="amount" value="{{ $ex->amount }}"
                                                        class="form-control">
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
