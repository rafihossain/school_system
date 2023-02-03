<div class="col-md-12 m-auto mb-3">
    <div class="row justify-content-center">
        <div class="card mt-3">
            <div class="card-header border-bottom bg-white pb-0 ps-2">
                <h4 class="card-title">Homework</h4>
            </div>
            <div class="card-body p-0">
                <table class="table">
                    <thead class="bg-light">
                        <tr>
                            <th>Teacher</th>
                            <th>Subject</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($homeworks as $homework)
                        <tr class="row_{{$homework->id}}">
                            <td>{{ $homework->teacher->name }}</td>
                            <td>{{ $homework->subject->subject_name }}</td>
                            <td>{{ date('F d, Y',strtotime($homework->start_date)).' - '.date('F d, Y',strtotime($homework->end_date)) }}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-sm btn-success homework_edit" data-id="{{ $homework->id }}">
                                    <i class="mdi mdi-file-edit-outline"></i>
                                </a>
                                <a href="{{ route('backend.delete-student-homework', ['id'=>$homework->id]) }}" id="delete" 
                                class="btn btn-sm btn-danger" data-id="{{$homework->id}}">
                                    <i class="mdi mdi-trash-can-outline"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>