<input type="hidden" name="id" value="{{ $homework->id }}">
<div class="mb-2">
    <label>Title <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="title" value="{{ $homework->title }}" 
    placeholder="Enter Name">
    <span class="text-danger title_error"></span>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-2">
            <label>Teacher <span class="text-danger">*</span></label>
            <select name="teacher_id" class="form-control teacher_id">
                <option value="">Select Teacher</option>
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}"
                    {{ $teacher->id == $homework->teacher->id ? 'selected' : '' }}>{{$teacher->name}}</option>
                @endforeach
            </select>
            <span class="text-danger" id="teacher_error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2">
            <label>Class <span class="text-danger">*</span></label>
            <select name="class_id" class="form-control class_id">
                <option value="">Select Name</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}"
                    {{ $class->id == $homework->class_id ? 'selected' : '' }}>{{$class->class_name}}</option>
                @endforeach
            </select>
            <span class="text-danger" id="class_error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2">
            <label>Section <span class="text-danger">*</span></label>
            <select name="section_id" class="form-control section_id">
                <option value="">Select Section</option>
                @foreach($sections as $section)
                    <option value="{{ $section->id }}"
                    {{ $section->id == $homework->section_id ? 'selected' : '' }}>{{$section->section_name}}</option>
                @endforeach
            </select>
            <span class="text-danger" id="section_error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2">
            <label>Subject <span class="text-danger">*</span></label>
            <select name="subject_id" class="form-control subject_id">
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" 
                    {{ $subject->id == $homework->subject_id ? 'selected' : '' }}>{{$subject->subject_name}}</option>
                @endforeach
            </select>
            <span class="text-danger" id="subject_error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2">
            <label>Start Date<span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="start_date" 
            value="{{ $homework->start_date }}">
            <span class="text-danger" id="start_date_error"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-2">
            <label>End Date<span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="end_date" 
            value="{{ $homework->end_date }}">
            <span class="text-danger" id="end_date_error"></span>
        </div>
    </div>
</div>
<div class="mb-2">
    <label>Description<span class="text-danger">*</span></label>
    <textarea name="description" cols="30" rows="5" class="form-control">{{ $homework->description }}</textarea>
    <span class="text-danger" id="description_error"></span>
</div>