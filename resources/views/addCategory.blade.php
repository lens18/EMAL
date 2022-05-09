@extends('layouts.main')

@section('beforeScript')

<style>
    #form-add-category{
        display: none;
    }
    #form-add-subCategory{
        display: none;
    }
    #form-add-materialCategory{
        display: none;
    }
</style>

@endsection

@section('content')

@if (Session::has('success'))
<script>
    Swal.fire(
        'Successful!',
        '{{ Session::get('
        success ')}}',
        'success'
    )

</script>
@elseif (Session::has('error'))
<script>
    Swal.fire(
        'Error!',
        '{{ Session::get('
        error ')}}',
        'error'
    )

</script>
@endif

<div class="row">

    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
            <h4 class="card-title">
                Tambah Kategori Barang
            </h4>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-4">
                    <div class="d-flex justify-content-between mb-2">
                        <h5>Kategori</h5>
                        <button class="btn btn-primary btn-sm add-category" data-status="none"><i class="fas fa-plus"></i></button>
                    </div>

                    <form action="/add_category" method="POST" class="mb-3" id="form-add-category">
                        @csrf
                        <div class="form row">
                            <div class="col-10 pr-1">
                                <input type="text" name="addkategori" value="" class="form-control" placeholder="MASUKKAN KATEGORI">
                            </div>
                            <div class="col-2 px-1">
                                <button class="btn btn-primary w-100" type="submit">Hantar</button>
                            </div>
                        </div>

                    </form>

                    <ul class="list-group ">
                        @foreach ($category as $item)

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p class="mb-0" style="text-transform:capitalize;" value="{{$item->id}}">{{ $item->name }}</p>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-secondary btn-sm view-sub-category" data-category-id="{{$item->id}}"><i class="fas fa-filter"></i></button>
                                {{-- <button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button> --}}
                                <button class="btn btn-danger btn-sm removeCategory" data-category-id="{{$item->id}}"><i class="fas fa-trash-alt"></i></button>
                            </div>

                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-4">
                    <div class="d-flex justify-content-between mb-2">
                        <h5>Sub Kategori</h5>
                        <button class="btn btn-primary btn-sm add-subCategory" data-status="none"><i class="fas fa-plus"></i></button>
                    </div>

                    <form action="/add_category" method="POST" class="mb-3" id="form-add-subCategory">
                        @csrf
                        <div class="form row">
                            <select id="kategori" class="form-control mb-3" name="kategori" style="margin-left: 10px; margin-right: 10px;">
                                @if ($category == null)
                                    <option selected>No Category</option>
                                @else
                                    <option disabled selected hidden>PILIH KATEGORI</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            <div class="col-10 pr-1">
                                <input type="text" name="addsubkategori" value="" class="form-control" placeholder="MASUKKAN SUB-KATEGORI">
                            </div>
                            <div class="col-2 px-1">
                                <button class="btn btn-primary w-100" type="submit">Hantar</button>
                            </div>
                        </div>


                    </form>

                    <ul class="list-group ul-sub-category">
                        @foreach ($subCategory as $item)

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p class="mb-0" style="text-transform:capitalize;" value="{{$item->id}}">{{ $item->name }}</p>

                            <div class="d-flex justify-content-end">
                                <button class="btn btn-secondary btn-sm view-material-category" onclick="viewMaterial('{{$item->id}}')"><i class="fas fa-filter"></i></i></button>
                                {{-- <button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button> --}}
                                <button class="btn btn-danger btn-sm removeSubCategory" onclick="removeSubCategory('{{$item->id}}')"><i class="fas fa-trash-alt"></i></button>
                            </div>

                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-4">
                    <div class="d-flex justify-content-between mb-2">
                        <h5>Nama Barang</h5>
                        <button class="btn btn-primary btn-sm add-materialCategory" data-status="none"><i class="fas fa-plus"></i></button>
                    </div>

                    <form action="/add_category" method="POST" class="mb-3" id="form-add-materialCategory">
                        @csrf
                        <div class="form row ">

                            <select id="subkategori" class="form-control mb-3" name="subkategori" style="margin-left: 10px; margin-right: 10px;">
                                @if ($subCategory == null)
                                    <option selected>No Category</option>
                                @else
                                    <option disabled selected hidden>PILIH SUB-KATEGORI</option>
                                    @foreach ($subCategory as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                @endif
                            </select>

                            <div class="col-10 pr-1">
                                <input type="text" type="text" name="addnamaBahan" class="form-control" placeholder="MASUKKAN NAMA BARANG">
                            </div>
                            <div class="col-2 px-1">
                                <button class="btn btn-primary w-100" type="submit">Hantar</button>
                            </div>
                        </div>


                    </form>

                    <ul class="list-group ul-material" >
                        @foreach ($materialCategory as $item)

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p class="mb-0" style="text-transform:capitalize;">{{ $item->name }}</p>

                            <div class="d-flex justify-content-end">
                                {{-- <button class="btn btn-secondary btn-sm"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button> --}}
                                <button class="btn btn-danger btn-sm removeMaterialCategory" onclick="removeMaterialCategory('{{$item->id}}')"><i class="fas fa-trash-alt"></i></button>

                            </div>

                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{-- <form action="/add_category" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p>Kategori</p>
                        <input type="text" name="addkategori" value="" class="form-control">
                    </div>
                </div>


                <div class=" text-right">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form> --}}
        </div>
{{--
        <div class="card-body">
            <form action="/add_category" method="POST" enctype="multipart/form-data">
            @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p>Kategori</p>
                            <select id="kategori" class="form-control mb-3" name="kategori">
                                @if ($category == null)
                                    <option selected>No Category</option>
                                @else
                                    <option disabled selected hidden>PLEASE SELECT CATEGORY</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        <p>Sub-Kategori</p>
                        <input type="text" name="addsubkategori" value="" class="form-control">
                    </div>
                </div>

                <div class=" text-right">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>

        <div class="card-body">
            <form action="/add_category" method="POST" enctype="multipart/form-data">
            @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <p>Sub-Kategori</p>
                            <select id="subkategori" class="form-control mb-3" name="subkategori">
                                @if ($subCategory == null)
                                    <option selected>No Category</option>
                                @else
                                    <option disabled selected hidden>PLEASE SELECT CATEGORY</option>
                                    @foreach ($subCategory as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        <p>Nama Bahan/Barang</p>
                        <input type="text" name="addnamaBahan" value="" class="form-control">
                    </div>
                </div>


                <div class=" text-right">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div> --}}
      </div>
    </div>
</div>

@endsection

@section('afterScript')

<script>
    $('.view-sub-category').click((e)=>{
        var category_id = $(e.currentTarget).attr('data-category-id');
        //console.log(category_id);

        $('ul.ul-sub-category').find('li').remove(); //remove ul li
        $('ul.ul-material').find('li').remove(); //remove ul li

        $.ajax({
            url: "{{ url('/getSubCategory') }}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, //laravel token
            data: {
                "category_id": category_id,
            },
            success: function (response) {
                console.log(response);

                $.each(response.success, (k,v)=>{

                    var li = $('<li>').addClass('list-group-item d-flex justify-content-between align-items-center').append(
                        $('<p>').addClass('mb-0').css('text-transform', 'capitalize').text(v.name),
                        $('<div>').addClass('d-flex justify-content-end').append(
                            $('<button>').addClass('btn btn-secondary btn-sm view-material-category').attr('onclick','viewMaterial("'+v.id+'")').html('<i class="fas fa-filter"></i>'),
                            $('<button>').addClass('btn btn-danger btn-sm removeSubCategory').attr('onclick','removeSubCategory("'+v.id+'")').html('<i class="fas fa-trash-alt"></i>')
                        )
                    )
                    $('ul.ul-sub-category').append(li);


                })


            }
        });
    });

    function viewMaterial(sub_category_id){
        $('ul.ul-material').find('li').remove(); //remove ul li

        $.ajax({
            url: "{{ url('/getMaterialCategory') }}",
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }, //laravel token
            data: {
                "sub_category_id": sub_category_id,
            },
            success: function (response) {
                console.log(response);

                $.each(response.success, (k,v)=>{

                    var li = $('<li>').addClass('list-group-item d-flex justify-content-between align-items-center').append(
                        $('<p>').addClass('mb-0').css('text-transform', 'capitalize').text(v.name),
                        $('<div>').addClass('d-flex justify-content-end').append(
                            $('<button>').addClass('btn btn-danger btn-sm removeMaterialCategory').attr('onclick','removeMaterialCategory("'+v.id+'")').html('<i class="fas fa-trash-alt"></i>')
                        )
                    )
                    $('ul.ul-material').append(li);

                })


            }
        });
    }

    $('.add-category').click((e)=>{
        var status = $(e.currentTarget).attr('data-status')
        if(status == 'none'){
            $('#form-add-category').fadeIn();
            $(e.currentTarget).attr('data-status', 'click')
        }else if(status == 'click'){
            $('#form-add-category').fadeOut();
            $(e.currentTarget).attr('data-status', 'none');
        }
    })

    $('.add-subCategory').click((e)=>{
        var status = $(e.currentTarget).attr('data-status')
        if(status == 'none'){
            $('#form-add-subCategory').fadeIn();
            $(e.currentTarget).attr('data-status', 'click')
        }else if(status == 'click'){
            $('#form-add-subCategory').fadeOut();
            $(e.currentTarget).attr('data-status', 'none');
        }
    })

    $('.add-materialCategory').click((e)=>{
        var status = $(e.currentTarget).attr('data-status')
        if(status == 'none'){
            $('#form-add-materialCategory').fadeIn();
            $(e.currentTarget).attr('data-status', 'click')
        }else if(status == 'click'){
            $('#form-add-materialCategory').fadeOut();
            $(e.currentTarget).attr('data-status', 'none');
        }
    })

    $('.removeCategory').click((e) => {
        var category_id = $(e.currentTarget).attr('data-category-id');
        console.log(category_id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('/remove_category') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, //laravel token
                    data: {
                        "category_id": category_id,
                    },
                    success: function (response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'Successfully deleted category',
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

    function removeSubCategory(subCategory_id){
        //console.log(subCategory_id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('/remove_subCategory') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, //laravel token
                    data: {
                        "subCategory_id": subCategory_id,
                    },
                    success: function (response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'Successfully deleted category',
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

    function removeMaterialCategory(materialCategory_id){
        //var materialCategory_id = $(e.currentTarget).attr('data-materialCategory-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('/remove_materialCategory') }}",
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }, //laravel token
                    data: {
                        "materialCategory_id": materialCategory_id,
                    },
                    success: function (response) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'Successfully deleted category',
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

</script>

@endsection
