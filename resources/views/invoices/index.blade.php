@extends('layouts.page')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Invoices</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Invoices</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">


            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        @include('layouts.partials.messages')
                        <h5 class="card-title">Manage Invoices</h5>
                        <!-- Table with stripped rows -->
                        <table class="table table-striped" id="tbl-invoice">
                            <div style='text-align: end' ;><a href="{{route('invoices.create')}}" class="btn btn-primary"><i class="bi bi-align-middle"></i><span>Add Invoice</span></a></div>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                           <tbody>


                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>







            </div>
        </div>
    </section>

</main>
@endsection
@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $.ajax({
            url: "{{route('api.load')}}",
            data : { type : 'invoice'},
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              $("#tbl-invoice tbody").html(data.data);
            }
        });
    });
</script>
@endpush
