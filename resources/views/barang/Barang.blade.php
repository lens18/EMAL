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

@endsection
