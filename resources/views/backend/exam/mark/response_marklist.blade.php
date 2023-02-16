<div class="card mt-3">
    <div class="card-header border-bottom bg-white pb-0 ps-2"></div>
    <div class="card-body p-0">
        <form id="save_student_mark">
            <table class="table">
                <thead class="bg-light">
                    <tr>
                        <th>Name</th>
                        <th>Roll</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Mark</th>
                        </tr>
                    </thead>
                <tbody>
                    @php
                        $marks = '';
                        $theory_mark = '';
                    @endphp

                    @foreach ($stdent_marks as $n => $stdent_mark)
                        
                        @php
                            if($stdent_mark->student_mark != null){
                                $marks = $stdent_mark->student_mark->mark;
                            }

                            $theory_mark = $stdent_mark->stubjectclass->theory_mark;
                            $practical_mark = $stdent_mark->stubjectclass->practical_mark;
                            $city_exam_mark = $stdent_mark->stubjectclass->city_exam_mark;
                            $diary = $stdent_mark->stubjectclass->diary;

                        @endphp

                        <tr>
                            <td>{{ $stdent_mark->getStudent->name }}</td>
                            <td>{{ $stdent_mark->roll_no }}</td>
                            <td>{{ $stdent_mark->class->class_name }}</td>
                            <td>{{ $stdent_mark->section->section_name }}</td>
                            <td>
                                <div class="d-flex">
                                    <!-- <input type="text" name="total_mark[]" value="" class="form-control" placeholder="Total Mark"> -->
                                    @if($theory_mark != 0)
                                        <input type="text" name="theory_mark[]" class="form-control" placeholder="{{ $theory_mark }}" 
                                        value="{{ $stdent_mark->student_mark != null ? $stdent_mark->student_mark->theory_mark : '' }}">
                                    @endif
                                    @if($practical_mark != 0)
                                        <input type="text" name="practical_mark[]" class="form-control" placeholder="{{ $practical_mark }}" 
                                        value="{{ $stdent_mark->student_mark != null ? $stdent_mark->student_mark->practical_mark : '' }}">
                                    @endif
                                    @if($city_exam_mark != 0)
                                        <input type="text" name="city_exam_mark[]" class="form-control" placeholder="{{ $city_exam_mark }}" 
                                        value="{{ $stdent_mark->student_mark != null ? $stdent_mark->student_mark->city_exam_mark : '' }}">
                                    @endif
                                    @if($diary != 0)
                                        <input type="text" name="diary[]" class="form-control" placeholder="{{ $diary }}" 
                                        value="{{ $stdent_mark->student_mark != null ? $stdent_mark->student_mark->diary : '' }}">
                                    @endif
                                    <input type="text" name="mark[]" class="form-control" placeholder="Total Mark" value="{{ $marks }}">
                                </div>
                                <input type="hidden" name="exam_id[]" class="form-control" value="{{ $exam_id }}">
                                <input type="hidden" name="subject_id[]" class="form-control" value="{{ $subject_id }}">
                                <input type="hidden" name="student_id[]" class="form-control" value="{{ $stdent_mark->user_id }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
        <button type="button" class="btn btn-primary m-2 save_student_mark">Save Mark</button>
    </div>
</div>