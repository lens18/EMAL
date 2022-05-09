@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                 Pengguna Telah Diluluskan
            </h4>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>No Syarikat</th>
                <th>No Perniagaan</th>
                <th>Nama Syarikat</th>
                <th>Profil Syarikat</th>
                <th></th>


              </thead>
              <tbody>
                @foreach ($user as $item)
                <tr>

                    <td>{{$item->noSyarikat}}</td>
                    <td>{{$item->noPerniagaan}}</td>
                    <td>{{$item->namaSyarikat}}</td>


                    <td>

                        <a class="btn btn-primary mr-1" href="/viewDetails/{{$item->id}}">Lihat butiran</a>

                    </td>

                    <td>
                        @if ($item->password == null || Auth::user()->roles->first()->name == 'admin' )

                        {{-- <a class="btn btn-primary mr-1" href="/send-email/{{$item->id}}">Approve</a> --}}
                        <button class="btn btn-danger reject" data-user-id="{{$item->id}}">Padam</button>

                        @endif

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
    $('.reject').click((e)=>{
        var user_id = $(e.currentTarget).attr('data-user-id');

        Swal.fire({
            title: 'Anda pasti?',
            text: "Anda tidak akan dapat mengembalikan ini!",
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
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},//laravel token
                    data: {
                        "user_id" : user_id,
                    },
                    success: function (response) {

                        Swal.fire({
                            title: 'Dipadam!',
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
