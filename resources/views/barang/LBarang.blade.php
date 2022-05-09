@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                SENARAI BAHAN/BARANGAN YANG DILULUSKAN
            </h4>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Nama Barang</th>
                <th></th>


              </thead>
              <tbody>
                @foreach ($material as $item)
                <tr>

                    <td>{{$item->materialCategori->name ?? ''}}</td>


                    <td>
                        <a class="btn btn-primary mr-1" href="/details_material/{{ $item->namaBahan }}"><i class="fas fa-search"></i></a>
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
