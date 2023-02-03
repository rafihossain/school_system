@extends('backend.layouts.app')
@section('title', 'Staff Details')
@section('content')
@php

@endphp

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row justify-content-center">
                    <div class="col-md-12 text-center mb-4">

                        <img src="{{asset('images/staff/'.$staff->getUser->user_Image)}}" alt="" class="avatar-xl rounded-circle">
                    </div>
                    <div class="col-6 text-end">
                        <p><strong>Name</strong></p>
                        <p><strong>Email</strong></p>
                        <p><strong>Phone</strong></p>
                        <p><strong>Gender</strong></p>
                        <p><strong>Present Address</strong></p>
                    </div>
                    <div class="col-6">
                        <p>{{$staff->getUser->name}}</p>
                        <p>{{$staff->getUser->email}}</p>
                        <p>{{$staff->getUser->mobile}}</p>
                        <p>{{$staff->getUser->mobile}}</p>
                        <p>{{$staff->present_address}}</p>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div> <!-- end row -->

<script>

</script>
@endsection