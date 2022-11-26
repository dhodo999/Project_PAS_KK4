<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ListMakanan;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabel = ListMakanan::all();

        return response()->json([
            "message" => "List Makanan",
            "data" => $tabel
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_makanan' => 'required|string',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer'
        ]);

        $data = ListMakanan::create([
            'nama_makanan' => $request->nama_makanan,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga
        ]);

        if ($data) {
            return response([
                'status' => 201,
                'message' => "Data List Makanan berhasil ditambahkan",
                'data' => $data
            ]);
        }else {
            return response([
                'status' => 401,
                'message' => "Data List Makanan gagal ditambahkan",
                'data' => null
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tabel = ListMakanan::find($id);
        if($tabel){
            return $tabel;
        }else{
            return ["message" => "Data List Makanan tidak ditemukan"];
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_method']);
        $update = ListMakanan::where("id", $id)->update($data);

        return response()->json([
            "message" => "Data berhasil diubah",
            "data" => $update
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tabel = ListMakanan::find($id);
        if($tabel){
            $tabel->delete();
            return ["message" => "Data List Makanan berhasil dihapus"];
        }else{
            return ["message" => "Data List Makanan tidak ditemukan"];
        }
    }
}
