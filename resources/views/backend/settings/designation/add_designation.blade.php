@extends('backend.layouts.app')
@section('title', 'Add Designation')
@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="{{ route('backend.manage-designation') }}" class="btn btn-primary "><i class="mdi mdi-plus"></i>List designation</a>
        </h4>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <form id="formDesignation" action="{{route('backend.save-designation')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-2">
                <label>Designation Name</label>
                <input type="text" class="form-control" name="designation_name"
                value="{{old('designation_name')}}">
                @error('designation_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Designation Short Name</label>
                <input type="text" class="form-control" name="designation_short_name"
                value="{{old('designation_short_name')}}">
                @error('designation_short_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Description</label>
                <textarea id="editor" class="form-control" name="description"></textarea>

                @error('description')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-check form-switch mb-2">
                <input type="hidden" name="designation_status" value="0">
                <input type="checkbox" class="form-check-input" id="customSwitch1" name="designation_status" value="1">
                <label class="form-check-label" for="customSwitch1">Active</label>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary" type="submit"> Add Designation </button>
            </div>
        </form>
    </div>
</div>


@endsection