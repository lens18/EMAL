@extends('layouts.main')

@section('beforeScript')
<style>
@media screen and (max-width: 1400px) {
    .fa-5x{
        font-size: 3em;
    }
}
</style>
@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                 Dashboard
            </h4>
        </div>
        <div class="card-body">
            <div class="content-wrapper">
                <div class="container-fluid">
                  <div class="row">


                    @if(Auth::user()->roles->first()->name == "admin" || Auth::user()->roles->first()->name == "superadmin")
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                        <div class="inforide">
                          <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-4 rideone">
                                <i class="fas fa-users fa-5x"></i>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                <h4>Kakitangan</h4>
                                <h2>{{$employeeCount}}</h2>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                        <div class="inforide">
                          <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
                                <i class="fas fa-bell fa-5x"></i>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                <h4>Permohonan Baru</h4>
                                <h2>{{$newRequest}}</h2>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
                        <div class="inforide">
                          <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridethree">
                                <i class="far fa-bell-slash fa-5x"></i>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                <h4>Permohonan Belum Selesai</h4>
                                <h2>{{$pendingRequest}}</h2>
                            </div>
                          </div>
                        </div>
                    </div>

                    @elseif((Auth::user()->roles->first()->name == "staff"))

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-2 mt-4">
                        <div class="inforide">
                          <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridetwo">
                                <i class="fas fa-bell fa-5x"></i>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                <h4>Permohanan Baru</h4>
                                <h2>{{$newRequest}}</h2>
                            </div>
                          </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-2 mt-4">
                        <div class="inforide">
                          <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-4 col-4 ridethree">
                                <i class="far fa-bell-slash fa-5x"></i>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-8 col-8 fontsty">
                                <h4>Permohonan Belum Selesai</h4>
                                <h2>{{$pendingRequest}}</h2>
                            </div>
                          </div>
                        </div>
                    </div>

                    @endif

                </div>
              </div>
        </div>
      </div>
    </div>
</div>

@endsection

@section('afterScript')
<script>
    $('.reject').click((e)=>{
        var user_id = $(e.currentTarget).attr('data-user-id');

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
                    url: "{{ url('/delete-user') }}",
                    method: 'post',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//laravel token
                    data: {
                        "user_id" : user_id,
                    },
                    success: function (response) {

                        Swal.fire({
                            title: 'Deleted',
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }else{
                                location.reload();
                            }
                        })


                    }
                });

            }
        })
    })
</script>
@endsection
