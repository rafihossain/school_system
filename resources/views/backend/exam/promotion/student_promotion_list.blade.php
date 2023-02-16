<div class="card">
    <div class="card-body table-responsive">

        <button type="button" class="btn btn-primary mb-3 promote_btn" 
        data-session-to="{{ $session_to }}" data-class-to="{{ $class_to }}">Promote</button>

        <table class="table table-bordered table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                    <th>SL NO</th>
                    <th>Student Name</th>
                    <th>Session Name</th>
                    <th>Class Name</th>
                    <th>Roll No</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td> <input type="checkbox" class="promote_check" value="{{ $student->id }}"></td>
                    <td>{{ $student->get_student->name }}</td>
                    <td>{{ $student->session->session_name }}</td>
                    <td>{{ $student->class->class_name }}</td>
                    <td>{{ $student->roll_no }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    var promote = [];
    $('.promote_btn').click(function(){
        // console.log('hello');

        $('.promote_check').each(function(){
            if($(this).is(':checked')){
                promote.push($(this).val());
            }
        });

        if(promote.length > 0){
            var student_id = promote;
            swal({
                title: "Are you sure?",
                text: "You want to promoted this student? This is one time process you cann't recover again!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willpromote) => {

                if(willpromote){
                    $.ajax({
                        url: "{{route('backend.promote-student-list')}}",
                        type: 'post',
                        data: {
                            'student_id' : student_id,
                            'session_to' : $(this).data('session-to'),
                            'class_to' : $(this).data('class-to'),
                            '_token' : '{{ csrf_token() }}',
                        },
                        success: function(res) {
                            iziToast.success({
                                message: 'Student promoted successfully!',
                                position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                            })
                        }
                    })
                }

            });
        }else{
            alert('Student checkbox are required!');
            return;
        }


    });
</script>