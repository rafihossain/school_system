@extends('backend.layouts.app')
@section('title', 'Teacher Details')
@section('content')

<div class="row justify-content-center">
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center mb-4">

                        <img src="{{asset('images/teacher/'.$teacher->teacher_profile_pic)}}" alt="" class="avatar-xl rounded-circle">
                    </div>
                    <div class="col-6 text-end">
                        <p><strong>Name</strong></p>
                        <p><strong>Email</strong></p>
                        <p><strong>Phone</strong></p>
                        <p><strong>Gender</strong></p>
                        <p><strong>Present Address</strong></p>
                    </div>
                    <div class="col-6">
                        <p>{{$teacher->getTeacher->name}}</p>
                        <p>{{$teacher->getTeacher->email}}</p>
                        <p>{{$teacher->getTeacher->mobile}}</p>
                        <p>{{$teacher->getTeacher->gender}}</p>
                        <p>{{$teacher->present_address}}</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div> <!-- end row -->

<script>

</script>
@endsection