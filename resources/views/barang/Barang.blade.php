@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                DETAIL BAHAN/BARANGAN YANG DILULUSKAN
            </h4>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Nama Barang</th>
                <th>Nama Pengeluar</th>
                <th>Jenama</th>
                <th>Negara Pengeluar</th>
                <th>Status</th>
                <th></th>


              </thead>
              <tbody>
                @foreach ($material as $item)
                <tr>

                    <td>{{$item->materialCategori->name ?? ''}}</td>
                    <td>{{$item->namaPengilang}}</td>
                    <td>{{$item->jenama}}</td>
                    <td>{{$item->negaraPengilang}}</td>
                    <td>
                        @if (isset($item->status))
                            @if (Auth::user()->roles->first()->name == "user")
                                {{$item->status}}
                            @else (Auth::user()->roles->first()->name == "admin")
                                <p
                                    @switch($item->status)
                                        @case('Pending')
                                            class="btn btn-primary"
                                            @break
                                        @case('Terima')
                                            @break
                                        @case('Tidak Terima')
                                            @break
                                        @default
                                            class="btn btn-primary"
                                    @endswitch
                                onclick="changeStatus('{{$item->id}}', '{{$item->status}}')"> {{$item->status}}</p>
                            @endif
                        @endif
                    </td>


                    <td>
                        <a class="btn btn-primary mr-1" href="/info_material/{{ $item->id }}"><i class="fas fa-search"></i></a>
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
   function changeStatus(id,status){

    var data = '';

    if(status == "Pending"){

        Swal.fire({
            title: 'Luluskan Barang?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Terima',
            denyButtonText: `Tidak Terima`,
        }).then((result) => {

            if(result.isConfirmed) {

                data = {
                    'id' : id,
                    'status' : 'Terima'
                }

            }else if(result.isDenied){

                data = {
                    'id' : id,
                    'status' : 'Tidak Terima'
                }
            }

            $.ajax({
                url: '/changeStatus',
                method: 'post',
                data: data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, //laravel token
                success: function(response) {

                    console.log(response);

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



        })
    }



    }
</script>

@endsection
