@extends('layouts.page')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Invoices</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('invoices.index')}}">Invoices</a></li>
                <li class="breadcrumb-item active">Update Invoice</li>
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
                        <h5 class="card-title"><strong>Update</strong> Invoice</h5>

                        <div style='text-align: end' ;><a href="{{route('invoices.index')}}" class="btn btn-primary"><i class="zmdi zmdi-arrow-left" style="padding-right: 6px;"></i><span>Back</span></a></div><br>

                        <!-- General Form Elements -->
                        <form method="post" enctype="multipart/form-data" action="#" id="invoiceform">
                            @csrf
                            @method('patch')
                        <div class="row mb-3">
                            <input type="hidden" name="id" value="{{ $invoice->id }}">
                            <label for="inputText" class="col-sm-2 col-form-label">Customer</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="customer_id" id="customer_id">
                                    <option selected disabled>Select a customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{$customer->id}}" {{$invoice->customer_id == $customer->id ? 'selected':''}}>{{$customer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="date" id="date" name="date" class="form-control" value="{{$invoice->date}}"
                                    placeholder="Enter New Date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Amount</label>
                            <div class="col-sm-10">
                                <input type="text" id="title" name="amount" class="form-control" value="{{$invoice->amount}}"
                                    placeholder="Enter Amount">
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                            <div class="col-sm-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="unpaid" {{$invoice->status == 'unpaid'?'checked':''}}>
                                    <label class="form-check-label" for="gridRadios1">
                                        Unpaid
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="paid" {{$invoice->status == 'paid'?'checked':''}}>
                                    <label class="form-check-label" for="gridRadios2">
                                        Paid
                                    </label>
                                </div>

                            </div>
                            <div class="col-sm-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="gridRadios3" value="cancelled" {{$invoice->cancelled == 'paid'?'checked':''}}>
                                    <label class="form-check-label" for="gridRadios2">
                                        Cancelled
                                    </label>
                                </div>

                            </div>
                        </fieldset>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="button" id="submit" class="btn btn-primary">Submit</button>
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
        //   $("#frmerrormsg").hide();
        e.preventDefault();
        //     $("#frmerrormsg").show();
        if (!$('#customer_id').val()) {
            $("#frmerrormsg").addClass('alert alert-danger').text("Please select a customer!");
            return false;
        }

        const formData = new FormData($("#invoiceform")[0]);
        formData.append('type', 'invoice');
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
               $("#frmerrormsg").addClass('alert alert-success').text('Invoice Updated Successfully');

            },
            error: function(data) {
                let responseText = data.responseText;
                let responseObject = JSON.parse(responseText);
                //console.log(responseObject.errors);
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
