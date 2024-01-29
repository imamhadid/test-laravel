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
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" disabled>
                        @else
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked
                                disabled>
                        @endif
                    </td>
                    <td>
                        <button type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal{{ $dataController->kode }}" class="btn btn-primary">edit</button>
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
                                            <span class="input-group-text" id="basic-addon1">Nama {{ $name }}</span>
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
                                                        <option value="{{ $dataController->kecamatan->kode }}" selected hidden>{{ $dataController->kecamatan->nama_kecamatan }}</option>
                                                        <option value="{{ $kecamatan->kode }}">{{ $kecamatan->nama_kecamatan }}</option>
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


                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
