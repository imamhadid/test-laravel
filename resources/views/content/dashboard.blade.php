@extends('dashboard.index')

@section('content')
    <div class="text-end">
        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary">add</button>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan {{ $name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    @csrf

                    @if ($name === 'pegawai')
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nama Lengkap</span>
                                <input type="text" class="form-control" name="nama" placeholder="{{ $name }}">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Tempat Lahir</span>
                                <input type="text" class="form-control" name="tempat" placeholder="Tempat">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Tanggal Lahir</span>
                                <input type="date" class="form-control" name="lahir" placeholder="{{ $name }}">
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Jenis Kelamin</span>
                                <select class="form-select" name="jk" aria-label="Default select example">
                                    <option value="laki-laki">Laki-Laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Agama</span>
                                <select class="form-select" name="agama" aria-label="Default select example">
                                    <option value="islam">Islam</option>
                                    <option value="kristen">Kristen</option>
                                    <option value="hindu">Hindu</option>
                                    <option value="budah">Budah</option>
                                    <option value="katolik">Katolik</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Alamat</span>
                                <input type="text" class="form-control" name="alamat">
                            </div>


                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Provinsi</span>
                                <select class="form-select" name="kode_prov" aria-label="Default select example">
                                    @foreach ($dataProvinsi as $provinsi)
                                        <option value="{{ $provinsi->kode }}">{{ $provinsi->nama_provinsi }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Kelurahan</span>
                                <select class="form-select" name="kode_kel" aria-label="Default select example">
                                    @foreach ($dataKelurahan as $kelurahan)
                                        <option value="{{ $kelurahan->kode }}">{{ $kelurahan->nama_kelurahan }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    @else
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Nama {{ $name }}</span>
                                <input type="text" class="form-control" name="name" placeholder="{{ $name }}">
                            </div>

                            @if ($name === 'kelurahan')
                                <select class="form-select" name="kode_kec" aria-label="Default select example">
                                    @foreach ($dataKecamatan as $kecamatan)
                                        <option value="{{ $kecamatan->kode }}">{{ $kecamatan->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            @endif

                        </div>
                    @endif
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @parent
    <table class="table table-dark p-3">
        <thead>
            <tr>
                <th scope="col">No</th>
                @if ($name === 'pegawai')
                    <th scope="col">Nama Pegawai</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Tgl. Lahir</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Agama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Provinsi</th>
                @else
                    <th scope="col">Kode</th>
                    <th scope="col">Nama {{ $name }}</th>
                    @if ($name === 'kelurahan')
                        <th scope="col">Nama Kecamatan</th>
                    @endif
                    <th scope="col">Active</th>
                @endif
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $dataController)
                <tr>
                    <th scope="row">1</th>
                    @if ($name === 'pegawai')
                        <td>{{ $dataController->nama }}</td>
                        <td>{{ $dataController->tempat_lahir }}</td>
                        <td>{{ $dataController->tgl_lahir }}</td>
                        <td>{{ $dataController->jk }}</td>
                        <td>{{ $dataController->agama }}</td>
                        <td>{{ $dataController->alamat }}</td>
                        <td>{{ $dataController->kelurahan->nama_kelurahan }}</td>
                        <td>{{ $dataController->kelurahan->kecamatan->nama_kecamatan }}</td>
                        <td>{{ $dataController->provinsi->nama_provinsi }}</td>
                        <td>

                            <button type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $dataController->id }}"
                                class="btn btn-primary">edit</button>
                            <a href="/delete/{{ $name }}/{{ $dataController->id }}" type="button"
                                class="btn btn-danger">delete</a>

                        </td>

                        <div class="modal fade" id="exampleModal{{ $dataController->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan {{ $name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">

                                            <input type="text" class="form-control" name="id"
                                                value="{{ $dataController->id }}" hidden>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Nama Lengkap</span>
                                                <input type="text" class="form-control" name="nama"
                                                    value="{{ $dataController->nama }}">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Tempat Lahir</span>
                                                <input type="text" class="form-control" name="tempat"
                                                    value="{{ $dataController->tempat_lahir }}">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Tanggal Lahir</span>
                                                <input type="date" class="form-control"
                                                    value="{{ $dataController->tgl_lahir->format('Y-m-d') }}"
                                                    name="lahir">
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Jenis Kelamin</span>
                                                <select class="form-select" name="jk"
                                                    aria-label="Default select example">
                                                    <option value="{{ $dataController->jk }}" hidden>
                                                        @if ($dataController->jk === 'laki-laki')
                                                            Laki-Laki
                                                        @else
                                                            Perempuan
                                                        @endif
                                                    </option>
                                                    <option value="laki-laki">Laki-Laki</option>
                                                    <option value="perempuan">Perempuan</option>
                                                </select>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Agama</span>
                                                <select class="form-select" name="agama"
                                                    aria-label="Default select example">
                                                    <option value="{{ $dataController->agama }}" hidden>
                                                        {{ $dataController->agama }}</option>
                                                    <option value="islam">Islam</option>
                                                    <option value="kristen">Kristen</option>
                                                    <option value="hindu">Hindu</option>
                                                    <option value="budah">Budah</option>
                                                    <option value="katolik">Katolik</option>
                                                    <option value="lainnya">Lainnya</option>
                                                </select>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Alamat</span>
                                                <input type="text" class="form-control" name="alamat"
                                                    value="{{ $dataController->alamat }}">
                                            </div>


                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Provinsi</span>
                                                <select class="form-select" name="kode_prov"
                                                    aria-label="Default select example">
                                                    @foreach ($dataProvinsi as $provinsi)
                                                        <option value="{{ $provinsi->kode }}">
                                                            {{ $provinsi->nama_provinsi }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Kelurahan</span>
                                                <select class="form-select" name="kode_kel"
                                                    aria-label="Default select example">
                                                    @foreach ($dataKelurahan as $kelurahan)
                                                        <option value="{{ $kelurahan->kode }}">
                                                            {{ $kelurahan->nama_kelurahan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <td>{{ $dataController->kode }}</td>
                        <td>
                            @if ($name === 'provinsi')
                                {{ $dataController->nama_provinsi }}
                            @elseif ($name === 'kecamatan')
                                {{ $dataController->nama_kecamatan }}
                            @elseif ($name === 'kelurahan')
                                {{ $dataController->nama_kelurahan }}
                            @endif
                        </td>
                        @if ($name === 'kelurahan')
                            <td>
                                {{ $dataController->kecamatan->nama_kecamatan }}
                            </td>
                        @endif
                        <td>
                            @if ($dataController->active !== 1)
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                    disabled>
                            @else
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                    checked disabled>
                            @endif
                        </td>
                        <td>
                            <button type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $dataController->kode }}"
                                class="btn btn-primary">edit</button>
                            <a href="/delete/{{ $name }}/{{ $dataController->kode }}" type="button"
                                class="btn btn-danger">delete</a>
                        </td>

                        <div class="modal fade" id="exampleModal{{ $dataController->kode }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambahkan {{ $name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">

                                            <input type="text" class="form-control" name="kode"
                                                value="{{ $dataController->kode }}" hidden>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">Nama
                                                    {{ $name }}</span>
                                                <input type="text" class="form-control" name="name"
                                                    placeholder="{{ $name }}"
                                                    value="@if ($name === 'provinsi') {{ $dataController->nama_provinsi }}@elseif ($name === 'kecamatan'){{ $dataController->nama_kecamatan }}@elseif ($name === 'kelurahan'){{ $dataController->nama_kelurahan }} @endif">
                                            </div>

                                            <div class="input-group mb-3">
                                                @if ($name === 'kelurahan')
                                                    <span class="input-group-text" id="basic-addon1">Nama kecamatan</span>
                                                    <select class="form-select" name="kode_kec"
                                                        aria-label="Default select example">
                                                        @foreach ($dataKecamatan as $kecamatan)
                                                            <option value="{{ $dataController->kecamatan->kode }}"
                                                                selected hidden>
                                                                {{ $dataController->kecamatan->nama_kecamatan }}</option>
                                                            <option value="{{ $kecamatan->kode }}">
                                                                {{ $kecamatan->nama_kecamatan }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            </div>

                                            <div class="input-group mb-3">

                                                <p class="mr-3">Active</p>

                                                @if ($dataController->active !== 1)
                                                    <input class="ml-3 form-check-input" name="status" type="checkbox"
                                                        value="" id="flexCheckDefault">
                                                @else
                                                    <input class="ml-3 form-check-input" name="status" type="checkbox"
                                                        value="1" id="flexCheckDefault" checked>
                                                @endif

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
