@extends('layouts.professors')
@section('title', 'بنك الأسئلة')

<body class="bg-light">
    @section('content')
        <div class="">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                إضافة سؤال
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">إضافة سؤال جديد</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="year_id" value="{{ $year_id }}">
                                <!-- الدورة الامتحانية -->
                                <select class="form-control mb-3" name="exam_cycle_id" required>
                                    <option value="">اختر دورة امتحانية</option>
                                    @foreach ($exam_cycles as $ex)
                                        <option value="{{ $ex->id }}">{{ $ex->name }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control mb-3" name="difficulty" id="">
                                    <option value="">نوع السؤال </option>
                                    <option value="easy">سهل</option>
                                    <option value="medium">متوسط</option>
                                    <option value="hard">صعب</option>
                                </select>
                                <label class="mb-2"> السؤال</label>
                                <textarea name="question" class="form-control mb-3" rows="5"></textarea>
                                <div class="">or</div>
                                <input type="file" name="question_image" class="form-control mb-3">
                                <label class="mb-2">الخيارات</label>
                                @for ($i = 0; $i < 4; $i++)
                                    <div class="d-flex align-items-center mb-2 gap-2">
                                        <input type="radio" name="correct_option" value="{{ $i }}" required>
                                        <input type="text" class="form-control" name="options[]"
                                            placeholder="الخيار {{ $i + 1 }}">
                                    </div>
                                @endfor
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>السؤال</th>
                        <th>درجة الصعوبة</th>
                        <th>الدورة الامتخانية</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse ($questions as $ex)
                        <tr>
                            <th>
                                <button class="btn btn-outline-success" type="button" data-bs-toggle="modal"
                                    data-bs-target="#exampleModa{{ $ex->id }}">
                                    {{ $i++ }}
                                </button>
                            </th>
                            <td>

                                @if ($ex->type == 'text')
                                    {{ $ex->question }}
                                @else
                                    <img width="150px" height="150px" src="{{ asset('storage/' . $ex->question) }}"
                                        alt="" srcset="">
                                @endif
                                {{--  --}}
                            </td>
                            <td>
                                {{ $ex->difficulty == 'easy' ? 'سهل' : ($ex->difficulty == 'medium' ? 'متوسط' : 'صعب') }}
                            </td>
                            <td>{{ $ex->exam_cycles->name }}</td>
                            <td>
                                <form action="{{ route('questions.destroy', $ex->id) }}" method="POST"
                                    onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        حذف
                                    </button>
                                </form>
                            </td>

                            <div class="modal fade" id="exampleModa{{ $ex->id }}" tabindex="-1"
                                aria-labelledby="exampleModa{{ $ex->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">إضافة سؤال جديد</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('questions.update', $ex->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <input type="hidden" name="year_id" value="{{ $year_id }}">

                                                <!-- الدورة الامتحانية -->
                                                <select class="form-control mb-3" name="exam_cycle_id" required>
                                                    @foreach ($exam_cycles as $cycle)
                                                        <option value="{{ $cycle->id }}"
                                                            {{ $cycle->id == $ex->exam_cycle_id ? 'selected' : '' }}>
                                                            {{ $cycle->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <!-- الصعوبة -->
                                                <select class="form-control mb-3" name="difficulty" required>
                                                    <option value="easy"
                                                        {{ $ex->difficulty == 'easy' ? 'selected' : '' }}>سهل</option>
                                                    <option value="medium"
                                                        {{ $ex->difficulty == 'medium' ? 'selected' : '' }}>متوسط</option>
                                                    <option value="hard"
                                                        {{ $ex->difficulty == 'hard' ? 'selected' : '' }}>صعب</option>
                                                </select>

                                                <!-- نص السؤال -->
                                                <label class="mb-2">السؤال</label>
                                                @if ($ex->type == 'image')
                                                    <img class="form-control"
                                                        src="{{ asset('storage/' . $ex->question) }}" alt=""
                                                        srcset="">
                                                    <input type="file" class="form-control mb-3" name="question_image"
                                                        id="">
                                                @else
                                                    <textarea name="question" class="form-control mb-3" rows="4" required>{{ $ex->question }}</textarea>
                                                @endif
                                                <label class="mb-2">الخيارات</label>

                                                @foreach ($ex->options as $index => $opt)
                                                    <div class="d-flex align-items-center mb-2 gap-2">
                                                        <input type="radio" name="correct_option"
                                                            value="{{ $index }}"
                                                            {{ $opt->is_correct ? 'checked' : '' }} required>

                                                        <input type="hidden" name="option_ids[]"
                                                            value="{{ $opt->id }}">

                                                        <input type="text" class="form-control" name="options[]"
                                                            value="{{ $opt->option_text }}">
                                                    </div>
                                                @endforeach

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        إغلاق
                                                    </button>

                                                    <button type="submit" class="btn btn-primary">
                                                        حفظ التعديلات
                                                    </button>
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
