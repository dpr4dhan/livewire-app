@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.11/dist/sweetalert2.min.css
" rel="stylesheet">
@endsection

@section('content')

    </head>
<div class="container p-5">
    <div class="row">
        @include('includes.messages')

        <div class="col-2 p-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#postCreateModal">Create New Post</button>
        </div>
        <div class="col-12">
            <table class="table table-bordered" id="postTable">
                <thead>
                    <th>SN</th>
                    <th>Title</th>
                    <th>Short Description</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>

            </table>
        </div>
    </div>

</div>
    @include('post.form')

@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.11/dist/sweetalert2.all.min.js
"></script>
    <script>
        let table = new DataTable('#postTable', {
            paging: true,
            serverSide: true,
            pageLength: 10,
            "ajax" : {
                url : '{{route('post.getData')}}',
                type: 'get',

            },
            columns: [
                {
                    data: 'DT_RowIndex'
                },
                {
                   data:  'title'
                },
                {
                    data: 'short_description',
                },
                {
                  data: 'authorName'
                },
                {
                    data: 'published_at',
                },
                {
                    data: 'action',
                }
            ]
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#published_at').datetimepicker({
            format: 'YYYY-MM-DD hh:MM A'
        });



        $('#postCreateForm').on('submit', function(e){
            e.preventDefault();

            let formData =  new FormData($('#postCreateForm')[0]);
            formData.append('_token', '{{csrf_token()}}');


            formData.forEach(function(val, key){
                console.log(val, key);
              if(key.includes('photo')){
                  if(val.name == ''){
                      formData.set(key, '');
                  }
              }
            });


            let post_id = $('#post_id').val();
            let formRoute = '';
            let method = '';
            if(post_id == 0){
                formRoute = '{{ route('post.store') }}';
                method = 'post';
            }else{
                formRoute = '{{route('post.update', ':id')}}';
                formRoute = formRoute.replace(':id', post_id);
                formData.append('_method', 'patch');
                method = 'post';
            }

            $.ajax({
                url: formRoute,
                type: method,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(response){
                    if(response.status){
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        })
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Occurred',
                            text: response.message,
                        })
                    }
                    table.ajax.reload();
                    $('#title').val('');
                    $('#short_description').val('');
                    $('#description').val('');
                    $('#published_at').val('');
                    $('#post_id').val('0');
                    $('#closePostCreateModal').trigger('click');
                },
                error: function(error){
                    let errors = error.responseJSON.errors;
                    $.each(errors, function(key, value){
                        key = key.replace('.', '');
                        $('#' + key + 'Error').html(value.toString());
                    });
                }

            });

       })

        $(document).on('click', '.editButton', function(e){
            let id = $(this).attr('data-id');

            let editRoute = '{{route('post.edit', ':id')}}';
            editRoute = editRoute.replace(':id', id);

            $.ajax({
                url: editRoute,
                type: 'get',
                success: function(res){
                    if(res.status){
                        let post = res.post;
                        console.log(post);
                        $('#title').val(post.title);
                        $('#short_description').val(post.short_description);
                        $('#description').val(post.description);
                        $('#published_at').val(post.published_at);
                        $('#post_id').val(id);

                        let photos = post.photos;
                        let html ='';
                        $(photos).each(function(key, value){
                            let i = generateRandomNumber();
                            html += '<div class="col-6 photoRow_'+ i +'">' +
                                        '<div class="mb-3">' +
                                            '<label for="caption'+ i +'" class="form-label">Caption</label>' +
                                            ' <input type="text" name="caption['+i+']" id="caption'+ i +'" class="form-control"  value="'+ value.caption +'">' +
                                            '<span class="text-danger" id="caption'+ i +'Error"></span>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="col-5 photoRow_'+ i +'">'+
                                        '<div class="mb-3">'+
                                            '<label for="photo'+ i +'" class="form-label">Photo</label>' +
                                            ' <input type="file" name="photo['+i+']" id="photo'+ i +'" class="form-control" >'+
                                            '<img src="{{ asset('storage/') }}/' + value.photo +'" alt="'+ value.photo +'"/>' +
                                            '<input type="hidden" name="selected_photo['+i+']" id="selected_photo'+ i +'" value="'+ value.photo +'" >' +
                                            '<span class="text-danger" id="photo'+ i +'Error"></span>'+
                                        '</div>'+
                                    '</div>' +
                                    '<div class="col-1 photoRow_'+ i +'">' +
                                        '<button data-row="'+ i +'" class="btn btn-danger photoRemoveRow"><i class="fa fa-trash"></i></button>'+
                                    '</div>';
                        });
                        $('#edit_photo_div').append(html);
                    }
                },
                error: function(err){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error occurred while fetching data',
                    })
                }
            });
        })

        $(document).on('click', '.deleteButton', function(e){
            let id = $(this).attr('data-id');
            let deleteRoute = '{{route('post.destroy', ':id')}}';
            deleteRoute = deleteRoute.replace(':id', id);
            Swal.fire({
                icon: 'warning',
                title: 'Do you want to delete the post?',
                showCancelButton: true,
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                       url: deleteRoute,
                        data: {
                           _token: '{{csrf_token()}}'
                        },
                       type: 'delete',
                       success:function(res){
                           if(res.status){
                               Swal.fire({
                                   icon: 'success',
                                   title: 'Success',
                                   text: res.message,
                               })
                               table.ajax.reload();
                           }else{
                               Swal.fire({
                                   icon: 'error',
                                   title: 'Error Occurred',
                                   text: res.message,
                               })
                           }
                       },
                        error:function(err){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error Occurred',
                                text: res.message,
                            })
                        }
                    });
                }
            })
        });

        $(document).on('click', '#addPhotoBtn', function(e){
            let i = generateRandomNumber();
            let html = '<div class="col-6 photoRow_'+ i +'">' +
                          '<div class="mb-3">' +
                           '<label for="caption'+ i +'" class="form-label">Caption</label>' +
                                ' <input type="text" name="caption['+i+']" id="caption'+ i +'" class="form-control" >' +
                            '<span class="text-danger" id="caption'+ i +'Error"></span>' +
                        '</div>' +
                    '</div>' +
                       ' <div class="col-5 photoRow_'+ i +'">'+
                           '<div class="mb-3">'+
                                '<label for="photo'+ i +'" class="form-label">Photo</label>' +
                               ' <input type="file" name="photo['+i+']" id="photo'+ i +'" class="form-control" >'+
                                    '<span class="text-danger" id="photo'+ i +'Error"></span>'+
                           '</div>'+
                        '</div>' +
                        '<div class="col-1 photoRow_'+ i +'">' +
                            '<button data-row="'+ i +'" class="btn btn-danger photoRemoveRow"><i class="fa fa-trash"></i></button>'+
                        '</div>';
           $('#add_photo_div').append(html);
        });

        $(document).on('click', '.photoRemoveRow', function(){
            let rowId = $(this).attr('data-row');
            $('.photoRow_'+ rowId).remove();
        })

        //for modal hidden event
        $(document).on('hidden.bs.modal', '#postCreateModal', function(){
            $('#title').val('');
            $('#short_description').val('');
            $('#description').val('');
            $('#published_at').val('');
            $('#post_id').val('0');
            $('#edit_photo_div').html('');
            $('#add_photo_div').html('');
        })

        function generateRandomNumber(){
          let x =   Math.floor((Math.random() * 10000) + 1);
          if(x == 1){
              generateRandomNumber();
          }
          return x;
        }
    </script>
@endsection
