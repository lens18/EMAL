<x-guest-layout>

    <x-slot name="logo">
        <a href="/">
            <x-application-logo class="w-200 h-20 fill-current text-gray-500" />
        </a>
    </x-slot>


    <div class="container-fluid" style="margin-top: 20px;">
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pendaftaran Syarikat</h4>
                        </div>
                        <div class="card-body">


                            <div class="row">
                                <!-- No Syarikat -->
                                <div class="col-md-3 mb-3">
                                    <p>No Pendaftaran Syarikat</p>
                                    <x-input id="noSyarikat" class="block mt-1 w-full" type="text" name="noSyarikat"
                                        :value="old('noSyarikat')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('noSyarikat')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <!-- No Perniagaan -->
                                <div class="col-md-3 mb-3">
                                    <p>No Pendaftaran PBT</p>
                                    <x-input id="noPerniagaan" class="block mt-1 w-full" type="text" name="noPerniagaan"
                                        :value="old('noPerniagaan')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('noPerniagaan')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <!-- Nama Syarikat -->
                                <div class="col-md-3 mb-3">
                                    <p>Nama Syarikat</p>
                                    <x-input id="namaSyarikat" class="block mt-1 w-full" type="text" name="namaSyarikat"
                                        :value="old('namaSyarikat')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('namaSyarikat')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <!-- Negara -->
                                <div class="col-md-3 mb-3">
                                    <p>Negara</p>
                                    <x-input id="negara" class="block mt-1 w-full" type="text" name="negara"
                                        :value="old('negara')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('negara')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                            </div>

                            <div class="row">
                                <!-- Alamat -->
                                <div class="col-md-12 mb-3">
                                    <p>Alamat</p>
                                    <textarea id="alamat" class="block mt-1 w-full form-control" type="text"
                                        name="alamat" :value="old('alamat')" autofocus
                                        style="resize: none"></textarea>

                                    <!-- Validation Errors -->
                                    @error('alamat')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <!-- Bandar -->
                                <div class="col-md-3 mb-3">
                                    <p>Bandar</p>
                                    <x-input id="bandar" class="block mt-1 w-full" type="text" name="bandar"
                                        :value="old('bandar')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('bandar')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <!-- Poskod -->
                                <div class="col-md-3 mb-3">
                                    <p>Poskod</p>
                                    <x-input id="poskod" class="block mt-1 w-full" type="text" name="poskod"
                                        :value="old('poskod')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('poskod')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <!-- Negeri -->
                                <div class="col-md-3 mb-3">
                                    <p>Negeri</p>
                                    <x-input id="negeri" class="block mt-1 w-full" type="text" name="negeri"
                                        :value="old('negeri')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('negeri')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- No Telephone -->
                                <div class="col-md-3 mb-3">
                                    <p for="">No Telephone</p>
                                    <x-input id="noTelephone" class="block mt-1 w-full" type="text" name="noTelephone"
                                        :value="old('noTelphone')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('noTelephone')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <!-- No Fax -->
                                <div class="col-md-3 mb-3">
                                    <p for="">No Faksimili</p>
                                    <x-input id="noFax" class="block mt-1 w-full" type="text" name="noFax"
                                        :value="old('noFax')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('noFax')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Email Address -->
                                <div class="col-md-3 mb-3">
                                    <p for="">Email</p>
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                        :value="old('email')" />

                                    <!-- Validation Errors -->
                                    @error('email')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <!-- Website -->
                                <div class="col-md-3 mb-3">
                                    <p for="">Website</p>
                                    <x-input id="website" class="block mt-1 w-full" type="text" name="website"
                                        :value="old('website')" autofocus />

                                    <!-- Validation Errors -->
                                    @error('website')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <!-- Status Pembekal -->
                                <div class="col-md-3 mb-3">
                                    <p for="">Status Syarikat</p>
                                    {{-- <x-input id="statusPembekal" class="block mt-1 w-full" type="text"
                                        name="statusPembekal" :value="old('statusPembekal')" autofocus /> --}}

                                    <select id="statusPembekal" class="form-control" name="statusPembekal">
                                        <option value="bumiputera" selected>BUMIPUTERA</option>
                                        <option value="non_bumiputera">BUKAN BUMIPUTERA</option>
                                    </select>

                                    {{-- <select id="statusPembekal" class="form-control" name="statusPembekal">
                                        <option value="bumiputera" selected
                                        @if ($user->statusPembekal=="bumiputera")
                                        selected
                                        @endif>BUMIPUTERA</option>
                                        <option value="non_bumiputera"
                                        @if ($user->statusPembekal=="bumiputera")
                                        selected
                                        @endif>BUKAN BUMIPUTERA</option>
                                    </select>

                                    <!-- Validation Errors -->
                                    @error('statusPembekal')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror --}}
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Document</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Upload Document -->
                                <div class="col-md-12 mb-3">
                                    <p for="">Sijil Pendaftaran Syarikat (SSM)</p>
                                    <input type="file" class="block mt-1 w-full" name="ssm_doc" />

                                    <!-- Validation Errors -->
                                    @error('ssm_doc')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <p for="">Lesen PBT</p>
                                    <input type="file" class="block mt-1 w-full" name="pbt_doc" />

                                    <!-- Validation Errors -->
                                    @error('pbt_doc')
                                        <small class="text-danger"> <i>{{ $message }}</i> </small>
                                    @enderror
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="flex items-center justify-end mt-4">
                                <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                    href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>
                                <x-button class="ml-4">
                                    {{ __('Register') }}
                                </x-button>
                            </div>
                        </div>
                    </div>

                </div>


        </form>
    </div>

    </div>

</x-guest-layout>
