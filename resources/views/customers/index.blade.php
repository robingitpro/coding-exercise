@extends('layouts.page')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Customers</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Customers</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">


            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Manage Customers</h5>
                        @include('layouts.partials.messages')
                        <!-- Table with stripped rows -->
                        <div style='text-align: end' ;><a href="{{route('customers.create')}}" class="btn btn-primary"><i
                                    class="bi bi-align-middle"></i><span>Add Customers</span></a></div>
                        <table class="table table-striped" id="tbl-customer">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Email</th>
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
            data : { type : 'customer'},
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              $("#tbl-customer tbody").html(data.data);
            }
        });
    });
</script>
@endpush
