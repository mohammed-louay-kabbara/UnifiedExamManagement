@extends('layouts.admin')
@section('title', 'إدارة أسئلة الامتحان')
@section('content')
    <div class="d-flex">
        <main class="flex-fill p-4">
            {{-- ===== اختيار الدورة الامتحانية (عرض فقط) ===== --}}
            <form method="GET" action="{{ route('admin.questions.show') }}" class="mb-4">
                <label class="mb-2">اختر الدورة الامتحانية</label>
                <div class="d-flex gap-2">
                    <select name="exam_cycle_id" class="form-control" required>
                        <option value="">-- اختر الدورة --</option>
                        @foreach ($exam_cycles as $cycle)
                            <option value="{{ $cycle->id }}"
                                {{ request('exam_cycle_id') == $cycle->id ? 'selected' : '' }}>
                                {{ $cycle->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary">عرض</button>

                </div>
            </form>
            @if (request('exam_cycle_id'))
                <form method="POST" action="{{ route('Exams.storeOrUpdate') }}">
                    @csrf
                    <button class="btn btn-success">
                        {{ !empty($selectedQuestions) ? 'تعديل الأسئلة' : 'حفظ الأسئلة' }}
                    </button>
                    <p>
                        عدد الأسئلة المختارة:
                        <strong id="selected-count">0</strong>
                    </p>
                    <input type="hidden" name="exam_cycle_id" value="{{ request('exam_cycle_id') }}">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th style="width:80px">اختيار</th>
                                <th>نص السؤال</th>
                                <th>الدكتور</th>
                                <th style="width:120px">الصعوبة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($questions as $q)
                                <tr>
                                    <td class="text-center">
                                        <input type="checkbox" name="question_ids[]" value="{{ $q->id }}"
                                            class="question-checkbox"
                                            {{ in_array($q->id, $selectedQuestions ?? []) ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        @if ($q->type == 'text')
                                            {{ $q->question }}
                                        @else
                                            <img width="620px" src="{{ asset('storage/' . $q->question) }}"
                                                alt="">
                                        @endif

                                    </td>
                                    <td>{{ $q->professor->name ?? '-' }}</td>
                                    <td>{{ $q->difficulty }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">
                                        لا يوجد أسئلة
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>


                </form>

            @endif


        </main>
    </div>
    <script>
        function updateSelectedCount() {
            const count = document.querySelectorAll('.question-checkbox:checked').length;
            document.getElementById('selected-count').innerText = count;
        }

        // عند التحميل (في حال كان هناك أسئلة محددة مسبقاً)
        updateSelectedCount();

        // الاستماع للتغيير
        document.querySelectorAll('.question-checkbox').forEach(cb => {
            cb.addEventListener('change', updateSelectedCount);
        });
    </script>
@endsection
