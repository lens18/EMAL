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

                                        {{-- <td>
                                            <a class="btn btn-primary" href="{{ $item->ssm_doc }}" target="_blank"><i
                                                    class="fas fa-eye"></i></a>
                                        </td>

                                        <td>
                                            <a class="btn btn-primary" href="{{ $item->pbt_doc }}" target="_blank"><i
                                                    class="fas fa-eye"></i></a>

                                        </td> --}}

                                        <td>
                                            @if ($item->statusSemakan == 'new request')
                                                Permohonan Baru
                                            @elseif ($item->statusSemakan == 'pending')
                                                Permohonan Belum Selesai
                                            @elseif ($item->statusSemakan == 'disemak')
                                                Permohonan Telah Disemak
                                            @endif
                                        </td>


                                        <td>
                                            <button class="btn btn-primary pickup" data-user-id="{{ $item->id }}">Ambil</button>
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
        $('.pickup').click((e) => {
            var user_id = $(e.currentTarget).attr('data-user-id');

            Swal.fire({
                title: 'Anda Pasti?',
                text: "anda tidak akan dapat mengembalikan ini!s",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, ambil permohonan ini!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('/pick-up') }}",
                        method: 'get',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        data: {
                            "user_id": user_id,
                        },
                        success: function(response) {

                            if(response.success){
                                Swal.fire({
                                    title: 'Berjaya!',
                                    icon: 'success',
                                    text: response.success,
                                    confirmButtonText: 'Ok',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    } else {
                                        location.reload();
                                    }
                                })
                            }else if(response.error){
                                Swal.fire({
                                    title: 'Error!',
                                    icon: 'error',
                                    text: response.error,
                                    confirmButtonText: 'Ok',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    } else {
                                        location.reload();
                                    }
                                })
                            }




                        }
                    });

                }
            })
        })
    </script>
@endsection
