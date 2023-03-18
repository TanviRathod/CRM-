@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>

                <div class="card-body">
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control first_name" name="first_name" value="{{$edit->first_name}}" placeholder="Enter First Name">
                    <span class="text-danger first_name_error"></span>
                </div>
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" class="form-control last_name" name="last_name" value="{{$edit->last_name}}" placeholder="Enter Last Name">
                    <span class="text-danger last_name_error"></span>
                
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Company</label>
                    <select class="form-control compancy_id" id="compancy_id">
                        <option >Select Company</option>
                        @foreach($compancy as $comp)
                        <option value="{{$comp->id}}" {{($comp->id ==  $edit->company_id ) ? 'selected' : ''}}>{{$comp->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control email" name="email" value="{{$edit->email}}" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" class="form-control phone" name="phone" value="{{$edit->phone}}" placeholder="Enter Phone">
                </div>
                <button type="submit" class="btn btn-success update">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $('.update').on('click',function(){
         
        var first_name=$('.first_name').val();
        var last_name=$('.last_name').val();
        var compancy_id = $('select#compancy_id option:selected').val();
        var email=$('.email').val();
        var phone=$('.phone').val();

        $.ajax({
            type: "PATCH",
            url: "{{route('employee.update',$edit->id)}}",
            data: {
                first_name:first_name,
                last_name:last_name,
                compancy_id:compancy_id,
                email:email,
                phone:phone,
            },
            dataType: "json",
            success: function (response) {
                if(response.status == "true")
                {
                    window.location.href = "{{route('employee.index')}}";    
                }
                else
                {
                    printErrorMsg(response.error);
                }
            }
        });
    });

    function printErrorMsg (msg) {
            $.each( msg, function( key, value ) {
                if(key == "first_name")
                {
                    $(".first_name_error").append(value);
                }
                
                if(key == "last_name")
                {
                    $(".last_name_error").append(value);
                }
            });
        }
</script>
@endsection