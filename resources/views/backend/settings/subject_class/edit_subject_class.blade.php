@extends('backend.layouts.app')
@section('title', 'Edit Subject Class')

@section('css')
    <style>
        .input_control{
             width:100%;
            color: #6c757d;
            border: 1px solid #ced4da;
            border-radius: 0.2rem;
            padding: 0.45rem 0.9rem;
        }
    </style>
@endsection

@section('content')

 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-subject-class') }}" class="btn btn-primary">List Subject</a>
        </h4>
    </div>
</div>

<div class="card">
	<div class="card-body">
		<form id="formSubject" action="{{route('backend.update-subject-class')}}" method="POST" enctype="multipart/form-data">
            @csrf 

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
                <tbody id="subject_table">
                    @foreach($subject_classes as $subject_class)
                        <tr>
                            <input type="hidden" name="section_id[]" value="{{ $subject_class->section_id }} ">
                            <td><input type="checkbox"></td>
                            <td><input type="text" name="subject_name[]" value="{{ $subject_class->subject_name }}" class="input_control"></td>
                            <td><input type="text" name="subject_code[]" value="{{ $subject_class->subject_code }}" class="input_control"></td>
                            <td><input type="text" name="total_mark[]" value="{{ $subject_class->subject_code }}" class="input_control"></td>
                            <td><input type="text" name="theory_mark[]" value="{{ $subject_class->subject_code }}" class="input_control"></td>
                            <td><input type="text" name="practical_mark[]" value="{{ $subject_class->subject_code }}" class="input_control"></td>
                            <td><input type="text" name="city_exam_mark[]" value="{{ $subject_class->subject_code }}" class="input_control"></td>
                            <td><input type="text" name="diary[]" value="{{ $subject_class->subject_code }}" class="input_control"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
			<div class="mt-4">
		        <button class="btn btn-primary" type="submit">Submit</button>
		    </div>
		</form>
	</div>
</div>

<script type="text/javascript">

</script>
@endsection