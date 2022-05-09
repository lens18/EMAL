@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')


@if (Session::has('success'))
<script>
    Swal.fire(
        'Successful!',
        '{{ Session::get('
        success ')}}',
        'success'
    )

</script>
@elseif (Session::has('error'))
<script>
    Swal.fire(
        'Error!',
        '{{ Session::get('
        error ')}}',
        'error'
    )

</script>
@endif

<div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"> List Admin
                    <!--<a class="btn btn-primary mr-1 float-right" href="">Add Admin</a>-->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#addAdmin">
                        Tambah Pegawai
                    </button>
                </h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Nama</th>
                            <th>Email</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <button class="btn btn-danger reject" data-user-id="{{$item->id}}">Padam</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List Kakitangan
                    <!--<a class="btn btn-primary mr-1 float-right" href="">Add Admin</a>-->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#addStaff">
                        Tambah Kakitangan
                    </button>
                </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Nama</th>
                            <th>Email</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($staff as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>

                                    <button class="btn btn-danger reject" data-user-id="{{$item->id}}">Padam</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Admin -->
    <div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Pegawai Baru </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/addPegawai" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah Pegawai</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Staff -->
    <div class="modal fade" id="addStaff" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Kakitangan Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/addStaff" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Tambah Kakitangan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('afterScript')
<script>
    $('.reject').click((e) => {
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
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, //laravel token
                    data: {
                        "user_id": user_id,
                    },
                    success: function (response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'Successfully deleted user',
                            confirmButtonText: 'Ok',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            } else {
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
