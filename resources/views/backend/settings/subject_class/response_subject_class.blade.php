@if(!is_null($subjectclasses))
<table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
    <thead>
        <tr>
            <th>SL No</th>
            <th>Subject Name</th>
            <th>Subject Code</th>
            <th>Total Mark</th>
            <th>Theory Mark</th>
            <th>Practical Mark</th>
            <th>City Exam Mark</th>
            <th>Diary</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subjectclasses as $subjectclass)
        <tr>
            <input type="hidden" name="subjectclass_id[]" value="{{ $subjectclass->id }}">
            <input type="hidden" name="subject_id[]" value="{{ $subjectclass->subject->id }}">

            <td><input type="checkbox"></td>
            <td><span>{{ $subjectclass->subject->subject_name }}</span></td>
            <td><span>{{ $subjectclass->subject->subject_code }}</span></td>
            <td>
                <input type="number" name="total_mark[]" value="{{ $subjectclass->total_mark }}" class="input_control">
            </td>
            <td>
                <input type="number" name="theory_mark[]" value="{{ $subjectclass->theory_mark }}" class="input_control">
                <input type="number" name="mintheory_mark[]" value="{{ $subjectclass->mintheory_mark }}" class="input_control">
            </td>
            <td>
                <input type="number" name="practical_mark[]" value="{{ $subjectclass->practical_mark }}" class="input_control">
                <input type="number" name="minpractical_mark[]" value="{{ $subjectclass->minpractical_mark }}" class="input_control">
            </td>
            <td>
                <input type="number" name="city_exam_mark[]" value="{{ $subjectclass->city_exam_mark }}" class="input_control">
                <input type="number" name="mincity_exam_mark[]" value="{{ $subjectclass->mincity_exam_mark }}" class="input_control">
            </td>
            <td>
                <input type="number" name="diary[]" value="{{ $subjectclass->diary }}" class="input_control">
                <input type="number" name="mindiary[]" value="{{ $subjectclass->mindiary }}" class="input_control">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mb-2">
    <button type="button" class="btn btn-primary" id="subjectListBtn">Submit</button>
</div>
@endif
