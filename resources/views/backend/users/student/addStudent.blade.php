@extends('backend.layouts.app')
@section('title', 'Create New Student')
@section('content')

<div class="card">
    <div class="card-body">
        <a class="btn btn-primary float-end" href="{{route('backend.student.index')}}">Back</a>
    </div>
</div>

@if(Session::has('success'))
    <div class="alert alert-success" style="text-align: center;">
        {{ Session::get('success') }}
    </div>
@endif

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body table-responsive">
                <form action="{{route('backend.save.student')}}" method="post" enctype="multipart/form-data" id="add_student">
                    @csrf
                    <div class="justify-content-center">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" placeholder="Enter Name">
                                @error('name')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Enter Email">
                                @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="Enter Password">
                                @error('password')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Parent<span class="text-danger">*</span></label>
                                <input type="text" name="" id="parents_id" class="form-control" autocomplete="off">

                                <input type="hidden" name="parent_id" id="parents_id_hidden" class="form-control" autocomplete="off" value="">

                                <div id="parent_list"></div>

                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Class<span class="text-danger">*</span></label>
                                <select name="class_id" id="class_id" class="form-control @error('class_id') is-invalid @enderror">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}">{{$class->class_name}}</option>
                                    @endforeach
                                </select>
                                @error('class_id')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Section<span class="text-danger">*</span></label>
                                <select name="section_id" id="section_id" class="form-control @error('section_id') is-invalid @enderror">
                                    <option value="">Select Section</option>

                                </select>
                                @error('section_id')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Department<span class="text-danger">*</span></label>
                                <select class="form-control @error('department_id') is-invalid @enderror" name="department_id" id="">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Admission Date<span class="text-danger">*</span></label>
                                <input type="date" name="admission_date" id="" class="form-control @error('admission_date') is-invalid @enderror">
                                @error('admission_date')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label>Roll No.<span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('roll_no') is-invalid @enderror" placeholder="Roll No" name="roll_no">
                                @error('roll_no')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label>Gender<span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Male
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Female
                                    </label>
                                </div>
                                @error('gender')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>


                        <div class="mb-2 text-center">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> <!-- end row -->

<script>
    $('#parents_id').on('keyup', function() {
        var query = $(this).val();
        $('.father_info').show();
        $(".guardian_info").hide();
        $.ajax({
            url: "{{route('backend.parent.parent_search')}}",
            type: 'GET',
            data: {
                'parent_name': query
            },
            success: function(data) {
                $('#parent_list').html(data);
            }
        })
    });

    $(document).on('click', 'li', function() {
        var value = $(this).text();
        var id = $(this).attr('data-id');
        $('#parents_id').val(value);
        $('#parents_id_hidden').val(id);
        $('#parent_list').html("");

    });

    $('#class_id').on('change', function(e) {
        var class_id = $(this).val();
        $.ajax({
            url: "{{route('backend.get_section')}}",
            type: 'GET',
            data: {
                'class_id': class_id
            },
            success: function(data) {
                //console.log(data);
                $("#section_id").html(data);
            }
        })
    });
</script>
@endsection