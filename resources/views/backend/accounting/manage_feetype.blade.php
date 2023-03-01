@extends('backend.layouts.app')
@section('title', 'List Free Type')
@section('content') 
<div class="card">
    <div class="card-body">
        <h4 class="m-0 header-title text-end float-end">
            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addfeetype-modal">
                <i class="mdi mdi-plus"></i> Add Feetype
            </a>
        </h4>
    </div>
</div>

<div class="card">
    <div class="card-body">
		<table class="table table-bordered dt-responsive table-responsive nowrap feetypelist_datatable">
            <thead>
                <tr>
                    <th> Name </th>
                    <th> Image </th>
                    <th> Action </th>
                </tr>
            </thead>
            <tbody>
                {{-- @php($i=1)
                @foreach($feetypes as $feetype)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$feetype->feetype_name}}</td>
                    <td>
                        <img src="{{asset($feetype->feetype_image)}}" height="50">
                    </td>
                    <td>
                        <a href="{{ route('backend.edit-feetype', ['id'=>$feetype->id]) }}" class="btn btn-sm btn-success">
                            <i class="mdi mdi-file-edit-outline"></i>
                        </a>
                        <a href="{{ route('backend.delete-feetype', ['id'=>$feetype->id]) }}" id="delete" class="btn btn-sm btn-danger">
                            <i class="mdi mdi-trash-can-outline"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                --}}
            </tbody>
        </table>
    </div>
</div>

<!-- Standard modal content -->
<div id="addfeetype-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addfeetype-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addfeetype-modalLabel">Create Feetype</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addfeetype_form">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label class="form-label">Feetype Name</label>
                        <input type="text" class="form-control" name="feetype_name">
                        <span class="text-danger feetype_name_error"></span>
                    </div>
                    <div class="form-group mb-2">
                        <label class="form-label">Upload Feetype</label>
                        <input type="file" class="dropify" id="feetypeImage" name="feetype_image">
                        <span class="text-danger feetype_image_error"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary create_feetype">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Standard modal content -->
<div id="feetypeimage-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="feetypeimage-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="feetypeimage-modalLabel">Feetype Image</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body feetype_image">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Edit Exam Modal -->
<div id="updatefeetype-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatefeetype-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="updatefeetype-modalLabel">Update Feetype</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updatefeetype_form">
                <input type="hidden" name="id" id="feetype_id">
                <div class="modal-body">
                    
                    <div class="mb-2">
                        <label class="form-label">Feetype Name</label>
                        <input type="text" class="form-control feetype_name" name="feetype_name">
                        <span class="text-danger feetype_name_error"></span>
                    </div>
                    
                    <div class="feetype_image"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary update_feetype">Save</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection


@section('script')
<script type="text/javascript">
    $(document).ready(function() {

        $('.dropify').dropify();

        var table = $('.feetypelist_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('backend.manage-feetype') }}",
            },
            columns: [
                {
                    data: 'feetype_name',
                    name: 'feetype_name'
                },
                {
                    data: 'photo',
                    name: 'photo'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('.create_feetype').click(function() {

            var formdata = new FormData(document.getElementById('addfeetype_form'));
            $.ajax({
                url: "{{route('backend.save-feetype')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#addfeetype-modal').modal('hide');
                    $('.feetypelist_datatable').DataTable().ajax.reload();
                },error: function(response) {
                    $('.feetype_name_error').text(response.responseJSON.errors.feetype_name);
                    $('.feetype_image_error').text(response.responseJSON.errors.feetype_image);
                }
            })

        });

        $(document).delegate('.feetype_edit', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.edit-feetype')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    $('#feetype_id').val(data.id);
                    $('.feetype_name').val(data.feetype_name);

                    var url = $('meta[name="base_url"]').attr('content');
                    var imagePath = url+'/images/accounting/feetype_image/'+data.feetype_image;

                    var html ='<label class="form-label">Upload Feetype</label><input type="file" class="dropify" id="feetypeImage" name="feetype_image" data-default-file="'+imagePath+'"><span class="text-danger feetype_image_error"></span>';
                    
                    $('.feetype_image').html(html);
                    $('.dropify').dropify();
                }
            })
        });

        $(document).delegate('.viewfeetype_image', 'click', function() {

            var id = $(this).data('id');
            $.ajax({
                url: "{{route('backend.view-feetype-image')}}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(data) {
                    var url = $('meta[name="base_url"]').attr('content');
                    var imagePath = url+'/images/accounting/feetype_image/'+data.feetype_image;
                    $('.feetype_image').html('<img src="'+imagePath+'" class="img-fluid" alt="">');
                }
            })
        });

        $('.update_feetype').click(function() {

            var formdata = new FormData(document.getElementById('updatefeetype_form'));
            $.ajax({
                url: "{{route('backend.update-feetype')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                cache : false,
                contentType: false,
                processData : false,
                data: formdata,
                success: function(data) {
                    $('#updatefeetype-modal').modal('hide');
                    $('.feetypelist_datatable').DataTable().ajax.reload();
                }, error: function(response) {
                    $('.feetype_name_error').text(response.responseJSON.errors.feetype_name);
                    $('.feetype_image_error').text(response.responseJSON.errors.feetype_image);
                }
            })

        });

        //delete sweetalert
        $(document).on('click', '.feetype_delete', function(e) {
            e.preventDefault();

            swal({
                    title: "Are you sure?",
                    text: "You want to delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        var id = $(this).data('id');
                        $.ajax({
                            url: "{{route('backend.delete-feetype')}}",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                $('.feetypelist_datatable').DataTable().ajax.reload();
                                iziToast.success({
                                    message: 'Successfully deleted recorded!',
                                    position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                                })
                            }
                        })

                    }

                });
        });

    });
</script>
@endsection