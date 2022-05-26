@extends('layouts.main')

@section('beforeScript')

@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Pendaftaran Bahan
                </h4>
            </div>
            <div class="card-body">
                <form action="/register_material" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist"
                            style="font-size: 18px;font-weight: 700;">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-barang"
                                    role="tab" aria-controls="pills-barang" aria-selected="true">Barang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-model-tab" data-toggle="pill" href="#pills-model" role="tab"
                                    aria-controls="pills-model" aria-selected="false">Model</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-dokumen-tab" data-toggle="pill" href="#pills-dokumen" role="tab"
                                    aria-controls="pills-dokumen" aria-selected="false">Dokumen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-syarat-tab" data-toggle="pill" href="#pills-syarat"
                                    role="tab" aria-controls="pills-syarat" aria-selected="false">Syarat Kelulusan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-perakuan-tab" data-toggle="pill" href="#pills-perakuan"
                                    role="tab" aria-controls="pills-perakuan" aria-selected="false">Perakuan</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            {{-- Bahagian Barang --}}
                            <div class="tab-pane fade show active" id="pills-barang" role="tabpanel" aria-labelledby="pills-barang">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <p>Kategori</p>
                                        <select id="kategori" class="form-control" name="kategori">

                                            @if ($category == null)
                                                <option selected>Tiada Kattegori</option>
                                            @else
                                                <option disabled selected hidden>SILA PILIH KATEGORI</option>
                                                @foreach ($category as $item)
                                                    <option value="{{$item->id}},{{$item->name}}">{{$item->name}}</option>
                                                @endforeach
                                            @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <p>Sub-Kategori</p>
                                        <select id="subkategori" class="form-control" name="subkategori">
                                            <option disabled selected hidden>SILA PILIH SUB KATEGORI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <p>Nama Bahan/Barang</p>
                                        <select id="namaBahan" class="form-control" name="namaBahan">
                                            <option disabled selected hidden>SILA PILIH NAMA BAHAN</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <p>Jenama</p>
                                        <input type="text" name="jenama" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <p>Nama Pengilang</p>
                                        <input type="text" name="namaPengilang" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3 ">
                                        <p>Alamat Pengilang</p>
                                        <textarea name="alamatPengilang" class="form-control" style="resize: none"
                                            rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <p>Negara Pengilang</p>
                                        <input type="text" name="negaraPengilang" value="" class="form-control">
                                    </div>
                                </div>
                            </div>

                            {{-- Bahagian Model --}}
                            <div class="tab-pane fade" id="pills-model" role="tabpanel" aria-labelledby="pills-model">

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <p>Model</p>
                                        <input type="text" name="model" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <p>RATED VOLTAGE (V)</p>
                                        <input type="text" name="ratedVoltage" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <p>SIZE (sq. mm)</p>
                                        <input type="text" name="size" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <p>NO. OF CORE</p>
                                        <input type="text" name="coreNo" value="" class="form-control">
                                    </div>
                                </div>

                            </div>

                            {{-- Bahagian Dokumen --}}
                            <div class="tab-pane fade" id="pills-dokumen" role="tabpanel" aria-labelledby="pills-dokumen">
                                <div class="col-md-12 mb-3 pl-0">
                                    <div class="card" style="border:none">
                                        <div class="card-body" style="padding: 0">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class=" text-primary">
                                                        <th>Jenis Dokumen</th>
                                                        <th>Tarikh Upload</th>
                                                        <th>Attachment</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Surat permohonan pendaftaran menggunakan kepala surat
                                                                (letter head) syarikat</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="leter_head" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Borang Akuan</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="borang_akuan" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Salinan Sijil / Lesen SIRIM Bhd</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="sijil_sirim" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Laporan Audit Pensijilan SIRIM Bhd</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="audit_sirim" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sijil / Lesen Persijilan dari makmal makmal di peringkat
                                                                antarabangsa</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Laporan ujian atau ujian jenis (Type Test) SIRIM Bhd
                                                            </td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Laporan ujian atau ujian jenis (Type Test) dari makmal-
                                                                makmal yang diiktiraf di peringkat antarabangsa</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Salinan perakuan kelulusan Suruhanjaya Tenaga (ST)</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Salinan surat kelulusan Jabatan Bomba & Penyelamat
                                                                Malaysia</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Profil Syarikat</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Borang Technical Information bagi bahan / barangan yang
                                                                dipohon.</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Authorization Letter sebagai pengedar yang sah daripada
                                                                pengilang bahan / barangan</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sampel bahan / barangan dikemukakan (jika perlu)</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Brosur / Katalog terperinci (Detail Technical Catalogue)</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Installation and operation manual, Maintenance dan
                                                                Service manual and/or method statement of installation
                                                            </td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Senarai Rujukan pengguna (senarai projek)</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sistem Q.A proses pembuatan</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Senarai cadangan harga (suggested retail price) bagi
                                                                bahan / barangan dan alat ganti.</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Salinan standard MS, IEC, EN, ISO, BS yang berkenaan
                                                                disertakan</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Senarai nama pengedar</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Adakah bahan/barangan ini mempunyai/ mematuhi Green
                                                                Label Certification / ISO 14001? Sekiranya ada, sila
                                                                kemukakan <br> dokumen sokongan yang berkaitan</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Adakah bahan/barangan ini mempunyai Laporan Ujian
                                                                Seismic? Sekiranya ada, sila kemukakan dokumen sokongan
                                                                <br> yang berkaitan.</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Borang Pendaftaran Syarikat (Form 49/Seksyen 14/Seksyen
                                                                58 Akta Syarikat)</td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Salinan lesen PBT (jika pengilang-Aktiviti pengilangan)
                                                            </td>
                                                            <td>N/A</td>
                                                            <td>
                                                                <!-- Upload Document -->
                                                                <input type="file" class="block mt-1 w-full" name="" />
                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Bahagian Syarat --}}
                            <div class="tab-pane fade" id="pills-syarat" role="tabpanel" aria-labelledby="pills-syarat">
                                <p><strong>SENARAI KELULUSAN BAHAN-BAHAN ELEKTRIK</strong></p>
                                <p>Sekiranya permohonan ini diluluskan pihak tuan / syarikat mesti memahami dan mematuhi
                                syarat – syarat senarai kelulusan bahan – bahan elektrik seperti berikut:-</p>
                                <ol>
                                    <li>
                                        Untuk mendapat penyenaraian tambahan ke atas sebarang model, pertukaran,
                                        pengubahsuaian dan sebagainya ke atas barangan sedia ada, tuan hendaklah memohon ke
                                        pejabat ini secara bertulis berkaitan perkara tersebut. Pejabat ini tidak bertanggungjawab ke
                                        atas sebarang kesulitan yang mungkin timbul berpunca daripada kegagalan pihak tuan
                                        memenuhi syarat-syarat tersebut.
                                    </li>
                                    <li>
                                        Senarai tersebut adalah untuk digunakan oleh Cawangan Kejuruteraan Elektrik JKR
                                        sahaja dan tidak boleh digunakan untuk apa jua pengiklanan atau untuk apa jua tujuan lain.
                                        Sila hubungi pejabat ini sekiranya terdapat sebarang kemusykilan berkaitan dengan perkara
                                        ini.
                                    </li>
                                    <li>
                                        Sekiranya tuan ingin kekalkan barangan tuan di dalam senarai JKR, tuan hendaklah
                                        memastikan ke semua kelulusan seperti Perakuan Kelulusan Suruhanjaya Tenaga, Lesen
                                        Pensijilan SIRIM dan Surat Kelulusan Jabatan Bomba dan Penyelamat yang mana berkenaan
                                        masih belum tamat tempohnya.Tuan hendaklah mengemukakan salinan sijil-sijil yang
                                        diperbaharui berserta Borang Akuan yang diperakui oleh Pesuruhjaya Sumpah sepanjang
                                        tempoh pendaftaran sebagai syarat untuk mengekalkan barangan berkenaan dalam senarai
                                        kelulusan.
                                    </li>
                                    <li>
                                        Cawangan Kejuruteraan Elektrik, JKR berhak untuk menarik balik kelulusan
                                        barangan ini sekiranya mendapati barangan ini tidak lagi mematuhi standard, kualiti yang
                                        ditetapkan, gagal dalam pengujian dan/atau gagal mengemukakan perkara yang disebutkan
                                        dalam para 3 di atas.
                                    </li>
                                    <li>
                                        Sila ambil perhatian bahawa pihak tuan hendaklah memastikan pembaharuan
                                        pendaftaran dibuat <strong>tiga bulan</strong> sebelum tarikh tamat kelulusan ini. Sekiranya pihak tuan
                                        gagal berbuat demikian, barangan tuan dengan sendirinya akan terkeluar daripada senarai
                                        bahan-bahan kelulusan JKR.
                                    </li>
                                </ol>
                            </div>

                            {{-- Bahagian Perakuan --}}
                            <div class="tab-pane fade" id="pills-perakuan" role="tabpanel" aria-labelledby="pills-perakuan">
                                <p>Adalah dengan ini disahkan bahawa:</p>
                                <ol>
                                    <li>
                                        Permohonan ini dibuat oleh saya selaku <strong> Lembaga Pengarah Syarikat /
                                        Pengarah Syarikat </strong>  / orang yang <strong> dilantik oleh Ahli Lembaga Pengarah Syarikat </strong>
                                        (Sila kemukakan surat lantikan sebagai wakil syarikat sekiranya nama pemohon
                                        tidak terdapat di
                                        Dalam Form 49/Seksyen 14/Seksyen 58 Akta Syarikat).
                                    </li>
                                    <li>
                                        Bahan / barangan yang didaftarkan ini adalah produk tulen dan bukan produk
                                        tiruan
                                    </li>
                                    <li>
                                        Pihak saya / syarikat akan bertanggungjawab sepenuhnya ke atas apa-apa aduan /
                                        kecacatan bahan / barangan yang didaftarkan ini
                                    </li>
                                    <li>
                                        Pihak saya / syarikat bersetuju tentang sebarang bentuk ujian yang akan
                                        dilakukan
                                        oleh pihak JKR terhadap bahan / barangan yang didaftarkan.
                                    </li>
                                    <li>
                                        Pihak saya / syarikat bersetuju tentang sebarang bentuk ujian yang akan
                                        dilakukan
                                        oleh pihak JKR terhadap bahan / barangan yang didaftarkan.
                                    </li>
                                    <li>
                                        Pihak saya / syarikat memahami proses pendaftaran bahan / barangan ini perlu
                                        dibuat dengan teliti dan mengikut syarat-syarat yang telah ditetapkan dan juga
                                        bergantung kepada kecukupan dokumen serta sampel yang dikemukakan. Pihak saya /
                                        syarikat juga bersetuju untuk mengambil balik sampel bahan / barangan pihak saya
                                        /
                                        syarikat selepas keputusan permohonan diketahui
                                    </li>
                                    <li>
                                        Pihak saya / syarikat akan menerima dan mematuhi Syarat-syarat senarai Kelulusan
                                        Bahan-bahan Elektrik sekiranya permohonan ini diluluskan seperti mana yang
                                        tertakluk dalam Lampiran A didalam borang ini.
                                    </li>
                                    <li>
                                        Pihak saya / syarikat memahami sekiranya permohonan pendaftaran ini telah gagal,
                                        pihak saya / syarikat tidak dibenarkan membuat permohonan semula selama tempoh
                                        tiga (3) bulan daripada tarikh surat tolak dikeluarkan kepada pihak saya /
                                        syarikat.
                                    </li>
                                    <li>
                                        Pihak saya / syarikat akan mengambil kembali sampel bahan / barangan dalam
                                        tempoh satu (1) bulan selepas menerima sijil kelulusan bahan/barangan.
                                        Sekiranya sampel tidak diambil dalam tempoh tersebut saya / syarikat tidak akan
                                        membuat sebarang tuntutan keatas sampel bahan/barangan tersebut.
                                    </li>
                                    <li>
                                        Pihak saya / syarikat akan memastikan semua dokumen yang dikemukakan adalah
                                        ASLI (ORIGINAL). Sekiranya didapati sebarang PEMALSUAN ke atas mana-mana
                                        dokumen tersebut, syarikat akan DISENARAI HITAM daripada membuat permohonan
                                        pendaftaran bahan/barangan dengan pihak JKR selama tempoh tidak melebihi tiga
                                        (3)
                                        tahun dan/atau tertakluk kepada keputusan Jawatankuasa Kelulusan Bahan (JKB)
                                        CKE,
                                        IPJKR Malaysia.
                                    </li>
                                </ol>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label>
                                        <input type="checkbox" name="perakuan" value="" aria-label="Checkbox for following text input"> Sila click untuk terima akuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class=" text-right">
                        <button class="btn btn-primary" type="submit">Kemas Kini</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection

    @section('afterScript')

    <script>

        //console.log();
       $('select[name=kategori]').change((e)=>{
            var category_id_name= $(e.currentTarget).val();
            var arrayCategory = category_id_name.split(',');

            $.ajax({
                url: "{{ url('/getSubCategory') }}",
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, //laravel token
                data: {
                    "category_id": arrayCategory[0],
                },
                success: function(response) {

                    var subCategory = $('select[name=subkategori]');
                    //console.log(subCategory);
                    if(response.success != null || response.success != undefined ){

                        $('select[name=subkategori]').find('option').remove();
                        $('select[name=namaBahan]').find('option').remove();

                        $('select[name=subkategori').prepend('<option disabled="disabled" hidden="hidden" selected="selected">PLEASE SELECT SUB KATEGORY</option>');
                        $('select[name=namaBahan').prepend('<option disabled="disabled" hidden="hidden" selected="selected">PLEASE SELECT NAMA BAHAN</option>');
                        if( response.success.length > 0){

                            $('select[name=subkategori]').find('option').each((k,v)=>{
                                if(k > 0){
                                    $(v).remove();
                                }
                            });

                            //$('select[name=subkategori]').find('option').remove();
                            $.each(response.success, (k,v)=>{
                                var option = $('<option>').attr({'value': v.id}).text(v.name);
                                subCategory.append(option);
                            })
                        }
                    }

                    if(response.error != null || response.error != undefined ){
                        $('select[name=subkategori]').find('option').remove();
                        $('select[name=namaBahan]').find('option').remove();
                    }
                }
            });
       });


       $('select[name=subkategori]').change((e)=>{
            var sub_category_id = $(e.currentTarget).val();

            $.ajax({
                url: "{{ url('/getMaterialCategory') }}",
                method: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}, //laravel token
                data: {
                    "sub_category_id": sub_category_id,
                },
                success: function(response) {

                    var materialCategory = $('select[name=namaBahan]');
                    //console.log(materialCategory);
                    if(response.success != null || response.success != undefined ){
                        $('select[name=namaBahan]').find('option').remove();
                        $('select[name=namaBahan').prepend('<option disabled="disabled" hidden="hidden" selected="selected">PLEASE SELECT NAMA BAHAN</option>');
                        if( response.success.length > 0){
                            $('select[name=namaBahan]').find('option').each((k,v)=>{
                                if(k > 0){
                                    $(v).remove();
                                }
                            });

                            $.each(response.success, (k,v)=>{
                                var option = $('<option>').attr({'value': v.id}).text(v.name);
                                materialCategory.append(option);
                            })
                        }
                    }

                    if(response.error != null || response.error != undefined ){
                        $('select[name=namaBahan]').find('option').remove();
                    }


                }
            });
       });

    </script>

    @endsection
