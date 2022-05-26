@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')

<div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">MAKLUMAT BAHAN/BARANGAN YANG DILULUSKAN
                @if($material->status == 'Terima')
                        <a class="btn btn-primary mr-1 float-right" href="/sijil/{{ $material->id }}" target="_blank">Sijil Kelulusan</a>
                @endif
            </h4>
        </div>
        <div style="margin-left:20px; margin-top:20px;">
            <p>Keterangan Barangan : {{$material->materialCategori->name ?? '' }} </p>
            <p>Nama Syarikat : {{$user->namaSyarikat}} </p>
            <p>No Telefon : {{$user->noTelephone}} </p>
            <p>No Fax : {{$user->noFax}} </p>
            <p>Email : {{$user->email}} </p>
            <p>Website : {{$user->website}} </p>
            <p>Jenama : {{$material->jenama}} </p>
            <p>Negara : {{$material->negaraPengilang}} </p>
        </div>
        <div class="card-body">

          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>Model</th>
                <th>RATED VOLTAGE (V)</th>
                <th>SIZE (sq. mm)</th>
                <th>NO. OF CORE</th>
                <th></th>


              </thead>
              <tbody>
                {{-- @foreach ($material as $index=>$item) --}}
                <tr>
                    <td>{{$material->model}}</td>
                    <td>{{$material->ratedVoltage}}</td>
                    <td>{{$material->size}}</td>
                    <td>{{$material->coreNo}}</td>
                </tr>
                {{-- @endforeach --}}

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
