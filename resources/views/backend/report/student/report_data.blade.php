@if(!$students->isEmpty())
<table class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>NAME</th>
            <th>ROLL NUMBER</th>
            <th>GENDER</th>
            <th>DATE OF BIRTH</th>
            <th>BLOOD GROUP</th>
            <th>ADMISSION DATE</th>
            <th>PARENT NAME</th>
            <th>PARENT PHONE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
          <tr>
            <td>{{$student->getStudent->name}}</td>
            <td>{{$student->roll_no}}</td>
            <td>{{$student->getStudent->gender}}</td>
            <td>{{$student->getStudent->date_of_birth}}</td>
            <td>{{$student->getStdAdditionalInfo->blood_group}}</td>
            <td>{{$student->admission_date}}</td>
            <td>{{$student->getParent->name}}</td>
            <td>{{$student->getStdAdditionalInfo->student_phone}}</td>
            <td><a href="{{route('backend.student.report.view',$student->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
          </tr>
        @endforeach    
    </tbody>
</table>
@endisset