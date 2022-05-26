@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <h4 class="card-title">
                        @if (Auth::user()->roles->first()->name == 'admin')
                            Menunggu Kelulusan
                        @elseif(Auth::user()->roles->first()->name == 'staff')
                            Menunggu Semakan
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>No Syarikat</th>
                                <th>No Perniagaan</th>
                                <th>Nama Syarikat</th>
                                <th>Status</th>
                                <th></th>

                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    <tr>
                                        <td>{{ $item->noSyarikat }}</td>
                                        <td>{{ $item->noPerniagaan }}</td>
                                        <td>{{ $item->namaSyarikat }}</td>

                                        <td>
                                            @if ($item->statusSemakan == 'new request')
                                                Permohonan Baru
                                            @elseif ($item->statusSemakan == 'pending')
                                                Diambil oleh <span style="text-transform:uppercase;"> {{$item->checked_by}} </span>
                                            @elseif ($item->statusSemakan == 'disemak')
                                                Disemak oleh <span style="text-transform:uppercase;"> {{$item->checked_by}} </span>
                                            @endif
                                        </td>

                                        <td>
                                            <a class="btn btn-primary mr-1" href="/viewApplication/{{ $item->id }}" >Lihat Permohonan</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
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
                title: 'Anda Pasti?',
                text: "Anda tidak akan dapat mengembalikan ini !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
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
                        success: function(response) {

                            Swal.fire({
                                title: 'Berjaya!',
                                icon: 'success',
                                text: 'Permohonan telah dipadam',
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

        $('.approve').click((e) => {
            var user_id = $(e.currentTarget).attr('data-user-id');

            var url = '{{ url('/send-email/:id') }}';
            url = url.replace(':id', user_id);

            Swal.fire({
                title: 'Anda Pasti?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya! Luluskan'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: url,
                        method: 'get',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        success: function(response) {

                            Swal.fire({
                                title: 'Berjaya!',
                                icon: 'success',
                                text: 'Email Telah Dihantar!',
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

        $('.semak').click((e) => {
            var user_id = $(e.currentTarget).attr('data-user-id');

            Swal.fire({
                title: 'Anda Pasti?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('/checked') }}",
                        method: 'get',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        data: {
                            "user_id": user_id,
                        },
                        success: function(response) {

                            Swal.fire({
                                title: 'Berjaya!',
                                icon: 'success',
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
