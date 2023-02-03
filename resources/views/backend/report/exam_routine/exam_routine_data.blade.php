 
<h4>Routines</h4>
<table class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>DATE(DAY/MONTH/YEAR)</th>
            <th>SUBJECT</th>
            <th>START TIME</th>
            <th>END TIME</th>
            <th>ROOM NO</th>
        </tr>
    </thead>
    <tbody>
      @foreach($exam_routines as $exam_routine)
        <tr>
            <td>{{$exam_routine->exam_date}}</td>
            <td>{{$exam_routine->subject->subject_name}}</td>
            <td>{{$exam_routine->start_time}}</td>
            <td>{{$exam_routine->end_time}}</td>
            <td>{{$exam_routine->class_room->classroom_name}}</td>
        </tr>
      @endforeach
    </tbody>
</table>
 