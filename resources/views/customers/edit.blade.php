@extends('layouts.page')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Customers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('customers.index')}}">Customers</a></li>
                <li class="breadcrumb-item active">Update Customer</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
               <div class="col-xs-12 col-sm-12 col-md-12">
                <div id="frmerrormsg"></div>
            </div>
            <div class="error_msg"></div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif




                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title"><strong>Update</strong> Customer</h5>

                        <div style='text-align: end' ;><a href="{{route('customers.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span>Back</span></a></div><br>

                        <!-- General Form Elements -->
                        <form method="post" enctype="multipart/form-data" action="#" id="customerForm">
                            @csrf
                            @method('patch')
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Customer Name</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="id" value="{{ $customer->id }}">
                                    <input type="text" id="name" name="name" class="form-control" value="{{$customer->name}}" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{$customer->phone}}"
                                        placeholder="Enter Phone Number">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" id="email" name="email" class="form-control" value="{{$customer->email}}"
                                        placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea id="address" name="address" class="form-control"
                                        placeholder="Enter Address">{{$customer->address}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">

                                <div class="col-sm-10">
                                    <button type="button" id="submit" class="btn btn-primary">Submit Form</button>
                                </div>
                            </div>

                        </form><!-- End General Form Elements -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#submit').click(function(e) {
        //$("#frmerrormsg").hide();
        e.preventDefault();
        if (!$('#name').val()) {
            //     $("#frmerrormsg").show();
            $("#frmerrormsg").addClass('alert alert-danger').text("Please enter a name!");
            return false;
        }

        const formData = new FormData($("#customerForm")[0]);
        formData.append('type', 'customer');
        $.ajax({
            type: 'POST',
            url: "{{route('api.edit')}}",
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {

                $("#frmerrormsg").removeClass('alert alert-danger');
                $("#frmerrormsg").addClass('alert alert-success').text('Customer Updated Successfully');

            },
            error: function(data) {

                let responseText = data.responseText;
                let responseObject = JSON.parse(responseText);
                let err_str = '';
                if (responseObject.errors) {

                    err_str = '<dl class="row"><dt class="col-sm-3"></dt><dt class="col-sm-9"><p><b>Whoops!</b> There were some problems with your input.</p></dt>';
                    $.each(responseObject.errors, function(key, val) {
                        err_str += '<dt class="col-sm-3">' + key.replace("_", " ") + ' </dt><dd class="col-sm-9">' + val +
                            '</dd>';
                    });
                    err_str += '</dl>';
                    $('.error_msg').addClass('alert alert-danger').html(err_str);
                    return;
                }
            }
        });
    });
</script>
@endpush
