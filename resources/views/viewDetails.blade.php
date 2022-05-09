@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">Butiran Syarikat
                        <a class="btn btn-primary mr-1 float-right" href="/dashboard">Kembali</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('viewDetails.update', ['user_id' => $user->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <p>No Syarikat</p>
                                <input @if (Auth::user()->roles->first()->name == 'staff')
                                disabled
                                @endif
                                type="text" name="noSyarikat" value="{{ $user->noSyarikat }}" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <p>No Perniagaan</p>
                                <input @if (Auth::user()->roles->first()->name == 'staff')
                                disabled
                                @endif type="text" name="noPerniagaan" value="{{ $user->noPerniagaan }}"
                                class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <p>Nama Syarikat</p>
                                <input @if (Auth::user()->roles->first()->name == 'staff')
                                disabled
                                @endif type="text" name="namaSyarikat" value="{{ $user->namaSyarikat }}"
                                class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <p>Negara</p>
                                <input @if (Auth::user()->roles->first()->name == 'staff')
                                disabled
                                @endif type="text" name="negara" value="{{ $user->negara }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <p for="">Alamat</p>
                                <textarea @if (Auth::user()->roles->first()->name == 'staff') disabled @endif name="alamat"
                                    class="form-control" style="resize: none">{{ $user->alamat }}
                                </textarea>
                            </div>
                            <div class="col-md-3 mb-3">
                                <p for="">Bandar</p>
                                <input @if (Auth::user()->roles->first()->name == 'staff')
                                disabled
                                @endif name="bandar" value="{{ $user->bandar }}" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <p>Poskod</p>
                                <input @if (Auth::user()->roles->first()->name == 'staff')
                                disabled
                                @endif type="text" name="poskod" value="{{ $user->poskod }}" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <p>Negeri</p>
                                <input @if (Auth::user()->roles->first()->name == 'staff')
                                disabled
                                @endif type="text" name="negeri" value="{{ $user->negeri }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <p>No Telephone
                                <p>
                                    <input @if (Auth::user()->roles->first()->name == 'staff')
                                    disabled
                                    @endif type="text" name="noTelephone" value="{{ $user->noTelephone }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <p>No Fax
                                <p>
                                    <input @if (Auth::user()->roles->first()->name == 'staff')
                                    disabled
                                    @endif type="text" name="noFax" value="{{ $user->noFax }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <p>Alamat Email
                                <p>
                                    <input @if (Auth::user()->roles->first()->name == 'staff')
                                    disabled
                                    @endif type="text" name="email" value="{{ $user->email }}" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <p>Website
                                <p>
                                    <input @if (Auth::user()->roles->first()->name == 'staff')
                                    disabled
                                    @endif type="text" name="website" value="{{ $user->website }}"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mb-3">
                                <p>Status Pembekal
                                <p>
                                    <select id="statusPembekal" class="form-control" name="statusPembekal" @if (Auth::user()->roles->first()->name == 'staff')
                                        disabled
                                        @endif>
                                        <option value="bumiputera" selected
                                        @if ($user->statusPembekal=="bumiputera")
                                        selected
                                        @endif>BUMIPUTERA</option>
                                        <option value="non_bumiputera"
                                        @if ($user->statusPembekal=="non_bumiputera")
                                        selected
                                        @endif>BUKAN BUMIPUTERA</option>
                                    </select>
                            </div>
                            {{-- <div class="col-md-2 mb-3">
                                <p>Status Aktif
                                <p>
                                    <input @if (Auth::user()->roles->first()->name == 'staff')
                                    disabled
                                    @endif type="text" name="statusAktif" value="{{ $user->statusAktif }}"
                                    class="form-control">
                            </div>
                            <div class="col-md-2 mb-3">
                                <p>Kategori
                                <p>
                                    <input @if (Auth::user()->roles->first()->name == 'staff')
                                    disabled
                                    @endif type="text" name="kategori" value="{{ $user->kategori }}"
                                    class="form-control">
                            </div> --}}
                        </div>
                        @if (Auth::user()->roles->first()->name == 'admin' || Auth::user()->roles->first()->name == 'superadmin')
                            <div class=" text-right">
                                {{-- <button class="btn btn-primary update-button" data-user="{{$user}}">Update</button> --}}
                                <button class="btn btn-primary" type="submit">Kemas kini</button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 ">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title">Attachment</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>Document Type</th>
                                <th>Date Uploaded</th>
                                <th>Attachment</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                @foreach ($user->attachment as $item)
                                    <tr>
                                        <td>{{ $item->doc_type }}</td>
                                        <td>{{ $item->upload_date }}</td>
                                        <td>
                                            @if ($item->doc_path == null)
                                                No Attachment
                                            @elseif($item->doc_path != null)
                                                <a class="btn btn-primary" href="{{ $item->doc_path }}"
                                                    target="_blank"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-secondary" href="{{ $item->doc_path }}"
                                                    target="_blank" download=""><i class="fas fa-download"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->attachment_status == 'Applied')
                                                {{ $item->attachment_status }}
                                            @elseif ($item->attachment_status == "Success")
                                                Diluluskan pada
                                                {{ \Carbon\Carbon::parse($item->approved_date)->toDateString() }}
                                            @elseif ($item->attachment_status == "Reject")
                                                Ditolak pada
                                                {{ \Carbon\Carbon::parse($item->approved_date)->toDateString() }}
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

    @if (Session::has('success'))
        <script>
            Swal.fire(
                'Berjaya!',
                '{{ Session::get('success') }}',
                'success'
            )
        </script>
    @elseif (Session::has('error'))
        <script>
            Swal.fire(
                'Error!',
                '{{ Session::get('error') }}',
                'error'
            )
        </script>
    @endif

@endsection
