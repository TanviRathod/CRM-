@extends('layouts.app')
@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Companies') }}</div>

                <div class="card-body">
                    <!-- Create Company -->
                    <!-- Modal -->
                    <div class="modal fade" id="company_create" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"> Company</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                    
                                    <form method="post" id="img_upload">
                                        <input type="hidden" class="company_id" name="company_id">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <span style="color:red">*</span>
                                            <input type="text" class="form-control name" name="name" placeholder="Enter name">
                                            <span class="text-danger name_error"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control email" name="email" placeholder="Enter email">
                                        </div>

                                        <div class="form-group">
                                            <label for="url">Website</label>
                                            <input type="text" class="form-control website" name="website" placeholder="Enter website">
                                        </div>
                                        <!-- 
                                        <div class="form-group Image">
                                            <label for="exampleInputPassword1">PDF</label>
                                            <input type="file" class="form-control pdf" name="pdf" id="pdf">
                                            <span class="text-danger logo_error"></span>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Address</label>
                                            <textarea name="address" class="form-control address" placeholder="Enter Address">  </textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary submit">Submit</button>
                                    <button class="btn btn-success update" style="display:none">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-success m-2 create_compancy" data-toggle="modal" data-target="#company_create">
                        Create New Company
                    </button>

                    <!-- End create Compncy -->

                    <!-- Display DataTable -->
                    <div class="card">
                        <div class="card-header">{{ __('Companies List') }}</div>
                        <div class="card-body">
                            <div class="container">
                                <h1></h1>
                                <table class="table  data-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Website</th>
                                            <th>Email</th>
                                            <th>Upload Image</th>
                                            <th>Upload PDF</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end Display Datatable  -->


                 
                    <!-- Logo Upload -->
                    <div class="modal fade" id="logo_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group Image">
                                            <label for="exampleInputPassword1">Logo</label>
                                            <input type="file" class="form-control" name="logo" id="logo">
                                            <span class="text-danger logo_error"></span>
                                            <input type="hidden" class="logo_id" name="logo_id">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary logo_upload_btn">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Logo Upload -->



                      <!-- File Upload -->
                      <div class="modal fade" id="File_upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Upload File</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group Image">
                                            <label for="exampleInputPassword1">PDF</label>
                                            <input type="file" class="form-control pdf" name="pdf" id="pdf">
                                            <span class="text-danger pdf_error"></span>
                                            <input type="hidden" class="pdf_id" name="pdf_id">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary pdf_upload_btn">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end File Upload -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
<style>
  .result{
    background-color: green;
    color:#fff;
    padding:20px;
  }
  .row{
    display:flex;
  }
</style>
</head>
<body>
    
<div class="row">
    <div class="col">
      <div style="width:500px;" id="reader"></div>
    </div>
    <div class="col" style="padding:30px;">
      <h4>SCAN RESULT</h4>
      <div id="result">Result Here</div>
    </div>
  </div>
  
</body>
</html> -->

<script type="text/javascript">
    function onScanSuccess(qrCodeMessage) {
        document.getElementById('result').innerHTML = '<span class="result">'+qrCodeMessage+'</span>';
    }
    
    function onScanError(errorMessage) {
      //handle scan error
    }
    
    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 250 });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
    
</script>



@push('scriptData')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function Data() {

        var table = $('.data-table').DataTable({
            //processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{ route('company.getdata') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'website',
                    name: 'website'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'logo',
                    name: 'logo',
                    // render: function(data, type, full, meta) {
                    //     return "<img src=\"/storage/images/" + data + "\" height=\"100\" with=\"100\"/>";
                    // }
                },
                {
                    data: 'pdf',
                    name: 'pdf'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    }
    Data();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //Create Company
    $('.submit').on('click', function(e) {
        e.preventDefault();

        var name = $('.name').val();
        var email = $('.email').val();
        var website = $('.website').val();
        var address = $('.address').val();
        var pdf = $('.pdf').val();

        var formData = new FormData();
        // var logo = $('#logo').prop('files')[0];
        formData.append('name', name);
        formData.append('email', email);
        // formData.append('logo', logo);
        formData.append('website', website);
        formData.append('address', address);
        // formData.append('pdf', pdf);

        $.ajax({
            type: "post",
            url: "{{route('company.store')}}",
            data: formData,
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                if (response.status == "true") {
                    Swal.fire(
                'Added!',
                'Company Added Successfully!',
                'success'
              )
                  $('#company_create .close').click();
                    $('#img_upload')[0].reset();
                    Data();
                } else {
                    printErrorMsg(response.error);
                }

            },
        });
    });

    function printErrorMsg(msg) {
        $.each(msg, function(key, value) {
            if (key == "name") {
                $(".name_error").html(value);
            }
            if (key == "logo") {
                $(".logo_error").html(value);
            }

            if (key == "pdf") {
                $(".pdf_error").html(value);
            }
        });
    }


    //reset Compancy form
    $(document).on('click','.create_compancy',function(){
        $('#img_upload')[0].reset();
        $('.update').hide();
        $('.submit').show();
    });


    //logo browse
    $(document).on('click','.logo_btn',function(e){
        let id = $(this).data('id');
        $('.logo_id').val(id);

    });

    //Logo Image Upload
    $(document).on('click','.logo_upload_btn',function(e){
        var formData = new FormData();
        var logo = $('#logo').prop('files')[0];
        alert(logo);
        var id=$('.logo_id').val();
        formData.append('logo', logo);
        formData.append('id',id);
        $(this).text('Uploding...')
        // formData.append('pdf', pdf);
        $.ajax({
            type: "post",
            url: "{{route('company.edit_logo')}}",
            data: formData,
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                if (response.status == "true") {
                    Swal.fire(
                'Upload!',
                'Image Upload Successfully!',
                'success'
              )
                  $('#logo_upload .close').click();
                    $('#logo').val('');
                    Data();
                } else {
                    printErrorMsg(response.error);
                }

            },
        });
    });



     //pdf browse
     $(document).on('click','.pdf_btn',function(e){
        let id = $(this).data('id');
        $('.pdf_id').val(id);

    });

   //PDF Upload
    $(document).on('click','.pdf_upload_btn',function(e){
        var formData = new FormData();
        var pdf = $('#pdf').prop('files')[0];
        var id=$('.pdf_id').val();
        formData.append('pdf', pdf);
        formData.append('id',id);
        // formData.append('pdf', pdf);
        $.ajax({
            type: "post",
            url: "{{route('company.edit_file')}}",
            data: formData,
            contentType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function(response) {
                if (response.status == "true") {
                    Swal.fire(
                'Upload!',
                'File Upload Successfully!',
                'success'
              )
                  $('#File_upload .close').click();
                    $('#pdf').val('');
                    Data();
                } else {
                    printErrorMsg(response.error);
                }

            },
        });
    });



    //Edit Company From
    $(document).on('click','.edit',function(e){
        e.preventDefault();
        var id = $(this).data('id');
       $.ajax({
        type: "post",
        url: "{{route('company.edit_compancy')}}",
        data: {
            id:id
        },
        dataType: "json",
        success: function (response) {
            if(response.status == "true")
            {
                  $(document).on('click','.edit',function(e){
        e.preventDefault();
        var id = $(this).data('id');
       $.ajax({
        type: "post",
        url: "{{route('company.edit_compancy')}}",
        data: {
            id:id
        },
        dataType: "json",
        success: function (response) {
            if(response.status == "true")
            {
                $('.name').val(response.edit_company.name);
                $('.email').val(response.edit_company.email);
                $('.website').val(response.edit_company.website);
                $('.address').val(response.edit_company.address);
                $('.company_id').val(response.edit_company.id);
                $('.submit').hide();
                $('.update').show();

                $('.first_name').val(response.edit_company.name);
                $('.last_name').val(response.edit_company.name);
                $('.email').val(response.edit_company.email);
                $('.company_id').val(response.edit_company.id);
                $('.phone').val(response.edit_compancy.phone);
                $('.submit').hide();
                $('.update').show();
            }
        }
       }); 
    }); 

            }
        }
       }); 
    }); 

   //Update Company
    $(document).on('click','.update',function(){
        var name= $('.name').val();
       var email=  $('.email').val();
        var website= $('.website').val();
       var address= $('.address').val();
      var id=  $('.company_id').val();
      $.ajax({
        type: "post",
        url: "{{route('company.update_compancy')}}",
        data: {
            id:id,
            name:name,
            email:email,
            address:address,
            website:website,
        },
        dataType: "json",
        success: function (response) {
            if (response.status == "true") {
                Swal.fire(
                'Updated!',
                'Company Updated Successfully!',
                'success'
              )
                  $('#company_create .close').click();
                    $('#img_upload')[0].reset();
                    Data();
                } else {
                    printErrorMsg(response.error);
                }
        }
      });
    });

    $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                        type: "post",
                        url: "{{route('company.delete')}}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.status == "true") {
                             Swal.fire(
                                    'Deleted!',
                                    'Company Delete Successfully!',
                                    'success'
                                )
                                Data();
                            }
                            else
                            {
                                Swal.fire(
                                    "Can't Delete!",
                                    'Company assign Employee!',
                                    'Danger'
                                )
                                Data();
                            }
                        }
                    });
          }
        })
      });
</script>
@endpush
@endsection