<?php

namespace App\Http\Controllers;

use App\Models\TKecamatan;
use App\Models\TKelurahan;
use App\Models\TPegawai;
use App\Models\TProvinsi;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(Request $request, $name)
    {
        if ($name === 'provinsi') {
            $data = TProvinsi::all();
        } else if ($name === 'kecamatan') {
            $data = TKecamatan::all();
        } else if ($name === 'kelurahan') {
            $dataKecamatan = TKecamatan::all();
            $data = TKelurahan::with('kecamatan')->get();
            return view("content.dashboard", compact('data', 'name', 'dataKecamatan'));
        } else if ($name === 'pegawai') {
            $dataKecamatan = TKecamatan::all();
            $data = TPegawai::with('kelurahan', 'provinsi', 'kelurahan.kecamatan')->get();
        } else {
            $data = [];
        }

        return view("content.dashboard", compact('data', 'name'));
    }


    public function store(Request $request, $name)
    {
        if ($name === 'provinsi') {
            $provinsi = TProvinsi::all();

            $data = TProvinsi::create([
                'kode' => 'P00' . count($provinsi) + 1,
                'nama_provinsi' => $request->name,
                'active' => true
            ]);
        } else if ($name === 'kecamatan') {
            $provinsi = TKecamatan::all();

            TKecamatan::create([
                'kode' => 'K00' . count($provinsi) + 1,
                'nama_kecamatan' => $request->name,
                'active' => true
            ]);
        } else if ($name === 'kelurahan') {
            $provinsi = TKelurahan::all();

            TKelurahan::create([
                'kode' => 'L00' . count($provinsi) + 1,
                'kode_kec' => $request->kode_kec,
                'nama_kelurahan' => $request->name,
                'active' => true
            ]);
        } else {
            $data = [];
        }


        return redirect('/' . $name);
    }

    public function update(Request $request, $name)
    {

        //dd($request->status);
        if ($name === 'provinsi') {

            $data = TProvinsi::where(['kode' => $request->kode,])
            ->update([
                'nama_provinsi' => $request->name,
                'active' => $request->status !== null ? true : false
            ]);
        } else if ($name === 'kecamatan') {

            TKecamatan::where(['kode' => $request->kode])
            ->update([
                'nama_kecamatan' => $request->name,
                'active' => $request->status !== null ? true : false
            ]);
        } else if ($name === 'kelurahan') {
            $provinsi = TKelurahan::all();

            TKelurahan::where(['kode' => $request->kode])
            ->update([
                'kode_kec' => $request->kode_kec,
                'nama_kelurahan' => $request->name,
                'active' => $request->status !== null ? true : false
            ]);
        } else {
            $data = [];
        }


        return redirect('/' . $name);
    }


    public function destroy(Request $request, $name, $id)
    {

        //dd($request->status);
        if ($name === 'provinsi') {
            TProvinsi::where(['kode' => $id,])->delete();
        } else if ($name === 'kecamatan') {
            TKecamatan::where(['kode' => $id,])->delete();
        } else if ($name === 'kelurahan') {
            TKelurahan::where(['kode' => $id,])->delete();
        } else {
            $data = [];
        }


        return redirect('/' . $name);
    }
}
