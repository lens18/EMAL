@extends('layouts.main')

@section('beforeScript')
    <style>
        button.btn.btn-danger.attachment-reject {
            width: 2.7rem;
        }

    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card shadow ">
                <div class="card-header">
                    <h4 class="card-title">Butiran Syarikat
                        <a class="btn btn-primary mr-1 float-right" href="/approval">Kembali</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <p>No Syarikat</p>
                            <input disabled type="text" name="noSyarikat" value="{{ $user->noSyarikat }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>No Perniagaan</p>
                            <input disabled type="text" name="noPerniagaan" value="{{ $user->noPerniagaan }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>No Telephone</p>
                            <input disabled type="text" name="noTelephone" value="{{ $user->noTelephone }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>No Fax</p>
                            <input disabled type="text" name="noFax" value="{{ $user->noFax }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <p>Nama Syarikat</p>
                            <input disabled type="text" name="namaSyarikat" value="{{ $user->namaSyarikat }}"
                                class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Negara</p>
                            <input disabled type="text" name="negara" value="{{ $user->negara }}" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Alamat Email</p>
                                <input disabled type="text" name="email" value="{{ $user->email }}"
                                    class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Website</p>
                            <input disabled type="text" name="website" value="{{ $user->website }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <p for="">Bandar</p>
                            <input disabled name="bandar" value="{{ $user->bandar }}" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Poskod</p>
                            <input disabled type="text" name="poskod" value="{{ $user->poskod }}" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Negeri</p>
                            <input disabled type="text" name="negeri" value="{{ $user->negeri }}" class="form-control">
                        </div>
                        <div class="col-md-3 mb-3">
                            <p>Status Pembekal</p>
                            <select id="statusPembekal" class="form-control" name="statusPembekal" @if (Auth::user()->roles->first()->name == 'staff' || Auth::user()->roles->first()->name == 'admin')
                                disabled
                                @endif>
                                <option value="bumiputera" selected @if ($user->statusPembekal == 'bumiputera')
                                    selected
                                    @endif>BUMIPUTERA</option>
                                <option value="non_bumiputera" @if ($user->statusPembekal == 'non_bumiputera')
                                    selected
                                    @endif>BUKAN BUMIPUTERA</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p for="">Alamat</p>
                            <textarea disabled name="alamat" rows="4" class="form-control" style="resize: none" >{{ $user->alamat }}
                                </textarea>
                        </div>
                    </div>
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
                                <th>Jenis Dokumen</th>
                                <th>Tarikh Muat Naik</th>
                                <th>Lampiran</th>
                                <th>Status</th>
                                <th></th>
                                <th>Alasan</th>
                            </thead>
                            <tbody>
                                @foreach ($user->attachment as $item)
                                    <tr>
                                        <td>{{ $item->doc_type }}
                                        @if($item->attachment_status == 'new_upload')
                                            <i class="fas fa-exclamation text-danger"></i>
                                        @endif

                                        </td>
                                        <td>
                                            @if ($item->doc_path == null)
                                                N/A
                                            @elseif($item->doc_path != null)
                                                {{ $item->upload_date }}
                                            @endif
                                        </td>
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
                                                Permohonan Baru
                                            @elseif ($item->attachment_status == "Success")
                                                Diluluskan pada
                                                {{ \Carbon\Carbon::parse($item->approved_date)->toDateString() }}
                                            @elseif ($item->attachment_status == "Reject")
                                                Ditolak Pada
                                                {{ \Carbon\Carbon::parse($item->approved_date)->toDateString() }}
                                            @elseif ($item->attachment_status == "new_upload")
                                                Upload File Baru pada
                                                {{ \Carbon\Carbon::parse($item->approved_date)->toDateString() }}
                                            @endif
                                        </td>

                                        <td>
                                            @if ( ($item->attachment_status == 'Applied' || $item->attachment_status == 'new_upload') && Auth::user()->roles->first()->name == 'staff')
                                                <button class="btn btn-success attachment-success" data-attachment-id='{{ $item->id }}'><i class="fas fa-check"></i></button>
                                                <button class="btn btn-danger attachment-reject" data-attachment-id='{{ $item->id }}'><i class="fas fa-times"></i></button>
                                            @elseif ($item->attachment_status == "Success" && Auth::user()->roles->first()->name == 'staff')
                                                <button class="btn btn-danger attachment-reject" data-attachment-id='{{ $item->id }}'><i class="fas fa-times"></i></button>
                                            @elseif ($item->attachment_status == "Reject" && Auth::user()->roles->first()->name == 'staff')
                                                <button class="btn btn-success attachment-success" data-attachment-id='{{ $item->id }}'><i class="fas fa-check"></i></button>
                                            @endif
                                        </td>

                                        <td class="text-danger">
                                            @if ($item->attachment_status == 'Reject')
                                                <i> {{ $item->comment }}</i>
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

        <div class="col-md-12 mb-3">
            <div class="card shadow ">
                <div class="card-header">
                    <h4 class="card-title">Komen</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-md-12 mb-3">

                            @if(count($user->comment) == 0)
                                <textarea name="comment" rows="5" class="form-control" style="resize: none"
                                @if($user->statusSemakan == 'disemak' || Auth::user()->roles->first()->name == 'admin')
                                disabled
                                @endif)></textarea><br>
                            @else
                                <textarea name="comment" rows="5" class="form-control" style="resize: none"
                                @if($user->statusSemakan == 'disemak' || Auth::user()->roles->first()->name == 'admin')
                                disabled
                                @endif)>{{$user->comment->first()->comment}}</textarea><br>
                            @endif

                            @if ($user->statusSemakan == 'disemak' && Auth::user()->roles->first()->name == 'admin')

                                <button class="btn btn-primary approve"data-user-id="{{ $user->id }}">Terima</button>

                            @elseif(($user->statusSemakan == 'new request' || $user->statusSemakan == 'pending') && Auth::user()->roles->first()->name == 'staff')

                                <button class="btn btn-primary semak" data-user-id="{{ $user->id }}">Terima</button>

                            @endif

                            @if ($user->statusSemakan == 'disemak' && Auth::user()->roles->first()->name == 'admin')

                                <button class="btn btn-danger reject" data-user-id="{{ $user->id }}">Tidak Terima</button>

                            @elseif(($user->statusSemakan == 'new request' || $user->statusSemakan == 'pending') && Auth::user()->roles->first()->name == 'staff')

                                <button class="btn btn-danger tidak" data-user-id="{{ $user->id }}">Tidak Terima</button>

                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('afterScript')
    <script>
        $('.attachment-success').click((e) => {
            var attach_id = $(e.currentTarget).attr('data-attachment-id');

            Swal.fire({
                title: 'Anda Pasti?',
                text: "Adakah anda mahu meluluskan Lampiran ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, luluskan! '
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('/approve-attachment') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        data: {
                            "attachment_id": attach_id,
                        },
                        success: function(response) {

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
                        }
                    });

                }
            })
        })

        $('.attachment-reject').click( async (e) => {
            //console.log($(e.currentTarget).attr('data-attachment-id'));
            var attach_id = $(e.currentTarget).attr('data-attachment-id');

            const { value: text } = await Swal.fire({

                // title: 'Are you sure?',
                // text: "Do you want to reject this Attachment?",
                icon: 'warning',
                input: 'textarea',
                inputLabel: 'Nyatakan Alasan',
                inputPlaceholder: 'Nyatakan Alasan Anda',
                inputAttributes: {
                    'aria-label': 'Nyatakan Alasan Anda'
                },
                showCancelButton: true
            })

            if (text) {
                Swal.fire({
                    title: 'Anda PastiAnda Pasti?',
                    text: "Adakah anda mahu menolak Lampiran ini??",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!'
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('/reject-attachment') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        data: {
                            "attachment_id": attach_id,
                            'comment' : text,
                        },
                        success: function(response) {

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
                        }
                    });
                }
            })

            }

        })

        $('.reject').click((e) => {
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
                        url: "{{ url('/send-email') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        data: {
                            "user_id": user_id,
                            "status" : 'realReject',
                        },
                        success: function(response) {

                            Swal.fire({
                                title: 'Berjaya!',
                                icon: 'success',
                                text: 'permohonan telah di padam',
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "/approval";
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

            Swal.fire({
                title: 'Anda Pasti?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Luluskan!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('/send-email') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        data: {
                            "user_id": user_id,
                            "status" : 'approve',
                        },
                        success: function(response) {

                            Swal.fire({
                                title: 'Berjaya!',
                                icon: 'success',
                                text: 'Email telah dihantar!',
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "/approval";
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
            var comment = $('textarea[name=comment]').val();

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
                        url: "{{ url('/add-comment') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        data: {
                            "user_id": user_id,
                            "comment": comment,
                            "status" : 'disemak',
                        },
                        success: function(response) {

                            Swal.fire({
                                title: 'Berjaya!',
                                icon: 'success',
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "/approval";
                                } else {
                                    location.reload();
                                }
                            })


                        }
                    });

                }
            })
        })

        $('.tidak').click((e) => {
            var user_id = $(e.currentTarget).attr('data-user-id');
            var comment = $('textarea[name=comment]').val();

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
                        url: "{{ url('/add-comment') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }, //laravel token
                        data: {
                            "user_id": user_id,
                            "comment": comment,
                            "status" : 'reject',
                        },
                        success: function(response) {

                            Swal.fire({
                                title: 'Berjaya!',
                                icon: 'success',
                                text: 'Permohonan telah ditolak',
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location = "/approval";
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
