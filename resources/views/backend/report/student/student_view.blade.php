@extends('backend.layouts.app')
@section('title', 'Student Details')
@section('content')
@php

@endphp

<div class="row justify-content-center mt-4">
    <div class="col-md-5">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row justify-content-center">
                    <h4>My Information</h4>
                    <hr>
                    <div class="col-md-12 text-center mb-4">
                        @if(isset($teacher->getTeacher->user_Image))
                        <img src="{{asset('images/teacher/')}}" alt="" class="avatar-xl rounded-circle">
                        @else
                        <img src="{{asset('images/student/default.png')}}" alt="" class="avatar-xl rounded-circle">
                        @endif
                    </div>
                    <div class="col-md-12">
                        <div class="row ">
                            <div class="col-6 text-end">
                                <p><strong>Name</strong></p>
                            </div>
                            <div class="col-6">
                                <p> {{$student->getStudent->name}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Email</strong></p>
                            </div>
                            <div class="col-6">
                                <p> {{$student->getStudent->email}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Class</strong></p>
                            </div>
                            <div class="col-6">
                                <p> {{$student->getClass->class_name}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Section</strong></p>
                            </div>
                            <div class="col-6">
                                <p> {{$student->getSection->section_name}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Roll No</strong></p>
                            </div>
                            <div class="col-6">
                                <p> {{$student->roll_no}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Admission Date</strong></p>
                            </div>
                            <div class="col-6">
                                <p> {{$student->admission_date}} </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row justify-content-center">
                    <h4>Parent Information</h4>
                    <hr>
                    <div class="col-md-12 text-center mb-4">

                        <img src="{{asset('images/student/default.png')}}" alt="" class="avatar-xl rounded-circle">
                    </div>
                    <div class="col-md-12">
                        <div class="row ">
                            <div class="col-6 text-end">
                                <p><strong>Name</strong></p>
                            </div>
                            <div class="col-6 ">
                                <p> {{$student->getParent->father_name}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Email</strong></p>
                            </div>
                            <div class="col-6 ">
                                <p> {{$student->getParent->getUser->email}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Phone</strong></p>
                            </div>
                            <div class="col-6 ">
                                <p> {{$student->getParent->getUser->mobile}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Gender</strong></p>
                            </div>
                            <div class="col-6 ">
                                <p> {{$student->getParent->getUser->gender}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p><strong>Occupation</strong></p>
                            </div>
                            <div class="col-6 ">
                                <p> {{$student->getParent->father_occupation}} </p>
                            </div>
                            <div class="col-6 text-end">
                                <p>&nbsp;</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div> <!-- end row -->

<script>

</script>
@endsection