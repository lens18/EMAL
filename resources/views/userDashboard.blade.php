@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="card-title">Butiran Syarikat
                    @if(Auth::user()->statusSemakan == 'approve')
                        <button class="btn btn-primary mr-1 float-right" data-toggle="modal" data-target="#change-password">Tukar katalaluan</button>
                    @endif
                </h4>
            </div>
            <div class="card-body">
                <form action="{{ route('viewDetails.update', ['user_id' => Auth::user()->id]) }}" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <p>No Syarikat</p>
                            <input
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            type="text" name="noSyarikat" value="{{ Auth::user()->noSyarikat }}" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>No Perniagaan</p>
                            <input
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            type="text" name="noPerniagaan" value="{{ Auth::user()->noPerniagaan }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Nama Syarikat</p>
                            <input
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            type="text" name="namaSyarikat" value="{{ Auth::user()->namaSyarikat }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Negara</p>
                            <input
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            type="text" name="negara" value="{{ Auth::user()->negara }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <p for="">Alamat</p>
                            <textarea
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            name="alamat" class="form-control" style="resize: none">{{ Auth::user()->alamat }}
                                        </textarea>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p for="">Bandar</p>
                            <input
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            name="bandar" value="{{ Auth::user()->bandar }}" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Poskod</p>
                            <input
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            type="text" name="poskod" value="{{ Auth::user()->poskod }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Negeri</p>
                            <input
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            type="text" name="negeri" value="{{ Auth::user()->negeri }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <p>No Telephone</p>
                                    <input
                                    @if(Auth::user()->statusSemakan != 'pending')
                                    disabled
                                    @endif
                                    type="text" name="noTelephone" value="{{ Auth::user()->noTelephone }}"
                                        class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>No Fax</p>
                                    <input
                                    @if(Auth::user()->statusSemakan != 'pending')
                                    disabled
                                    @endif
                                    type="text" name="noFax" value="{{ Auth::user()->noFax }}"
                                        class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <p>Alamat Email</p>
                                    <input
                                    @if(Auth::user()->statusSemakan != 'pending')
                                    disabled
                                    @endif
                                    type="text" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Website</p>
                            <input
                            @if(Auth::user()->statusSemakan != 'pending')
                            disabled
                            @endif
                            type="text" name="website" value="{{ Auth::user()->website }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <p>Status Pembekal</p>
                            <select id="statusPembekal" class="form-control" name="statusPembekal"
                                @if (Auth::user()->statusSemakan != 'pending')
                                disabled
                                @endif>
                                <option value="bumiputera" selected @if (Auth::user()->statusPembekal == 'bumiputera')
                                    selected
                                    @endif>BUMIPUTERA</option>
                                <option value="non_bumiputera" @if (Auth::user()->statusPembekal == 'non_bumiputera')
                                    selected
                                    @endif>BUKAN BUMIPUTERA</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" value="user_update_detail" name=status>
                        @if (Auth::user()->statusSemakan == 'pending')
                            <div class=" text-right">
                                {{-- <button class="btn btn-primary update-button" data-user="{{$user}}">Update</button> --}}
                                <button class="btn btn-primary" type="submit">Kemas Kini</button>
                            </div>
                        @endif
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <div class="card shadow">
            <div class="card-header">
                <h4 class="card-title">Lampiran</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th>Jenis Document</th>
                            <th>Tarikh Muat Naik</th>
                            <th>Lampiran</th>
                            <th>Status</th>

                            @if (Auth::user()->statusSemakan == 'pending')
                             <th>Alasan</th>
                            @endif

                            <th></th>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->attachment as $item)
                                <tr>
                                    <td>{{ $item->doc_type }}</td>
                                    <td>{{ $item->upload_date }}</td>
                                    <td>
                                        @if ($item->doc_path == null)
                                            Tiada Lampiran
                                        @elseif($item->doc_path != null)
                                            <a class="btn btn-primary" href="{{ $item->doc_path }}"
                                                target="_blank"><i class="fas fa-eye"></i></a>
                                            <a class="btn btn-secondary" href="{{ $item->doc_path }}" target="_blank" download=""><i class="fas fa-download"></i></a>
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
                                        @elseif ($item->attachment_status == "new_upload")
                                            Muatnaik File baru pada
                                            {{ \Carbon\Carbon::parse($item->approved_date)->toDateString() }}
                                        @endif
                                    </td>

                                    @if (Auth::user()->statusSemakan == 'pending')
                                            <td>
                                                {{ $item->comment }}
                                            </td>
                                    @endif

                                    <td>
                                        @if($item->attachment_status == "Reject")
                                        <button class="btn btn-outline-primary upload-doc" data-attachment-id="{{ $item->id }}"  data-attachment-type="{{ $item->doc_type }}" data-toggle="modal" data-target="#upload_doc"><i class="fas fa-upload"></i>
                                            @if($item->doc_type == "Sijil SSM")
                                            Upload SSM DOC
                                            @elseif($item->doc_type == "Sijil PBT")
                                            Upload PBT DOC
                                            @endif
                                        </button>
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

    @if(Auth::user()->statusSemakan == 'pending')
    <div class="col-md-12 mb-3">
        <div class="card shadow ">
            <div class="card-header">
                <h4 class="card-title">Komen </h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-md-12 mb-3">
                        <textarea name="comment" rows="5" class="form-control" style="resize: none" disabled>{{Auth::user()->comment->first()->comment}}</textarea><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Modal upload Doc -->
<div class="modal fade" id="upload_doc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Muat Naik Dokumen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/upload-doc" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="" name="attachment_id">
                <input type="hidden" value="" name="attachment_type">
                <div class="form-group">
                    <label for="">Dokumen</label>
                    <input type="file" name="doc" class="form-control">
                </div>

                <div class="text-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Muat Naik Dokumen Baru</button>
                </div>

            </form>
        </div>
    </div>
</div>
</div>

<!-- Modal Change Password-->
<div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tukar Kata Laluan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('update_password') }}" method="POST" >
                @csrf
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <p>Katalaluan Lama</p>
                            <input type="password" name="current_password" class="form-control" id="current_password">
                        </div>

                        <!-- Validation Errors -->
                        @error('current_password')
                            <small class="text-danger"> <i>{{ $message }}</i> </small>
                        @enderror

                    </div>
                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <p>Katalaluan Baru</p>
                            <input type="password" name="new_password" class="form-control" id="new_password">
                        </div>


                        <!-- Validation Errors -->
                        @error('new_password')
                            <small class="text-danger"> <i>{{ $message }}</i> </small>
                        @enderror

                    </div>

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <p>Sahkan Katalaluan</p>
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                        </div>

                        <!-- Validation Errors -->
                        @error('confirm_password')
                            <small class="text-danger"> <i>{{ $message }}</i> </small>
                        @enderror

                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Tukar Kata Laluan</button>
                    </div>
                </form>
        </div>
    </div>
</div>
</div>

@endsection

@section('afterScript')
<script>
    $('.upload-doc').click((e)=>{
        var attachment_id  = $(e.currentTarget).attr("data-attachment-id");
        var attachment_type  = $(e.currentTarget).attr("data-attachment-type");
        $('input[name=attachment_id]').val(attachment_id);
        $('input[name=attachment_type]').val(attachment_type);
    })
</script>



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
