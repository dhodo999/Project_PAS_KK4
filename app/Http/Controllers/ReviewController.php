<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabel = Review::all();

        return response()->json([
            "message" => "Reviews",
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
            'nama' => 'required|string',
            'email' => 'required|string',
            'komen' => 'required|string'
        ]);

        $data = Review::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'komen' => $request->komen
        ]);

        if ($data) {
            return response([
                'status' => 201,
                'message' => "Data Review berhasil ditambahkan",
                'data' => $data
            ]);
        }else {
            return response([
                'status' => 401,
                'message' => "Data Review gagal ditambahkan",
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
        $tabel = Review::find($id);
        if($tabel){
            return $tabel;
        }else{
            return ["message" => "Data Review tidak ditemukan"];
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
        $update = Review::where("id", $id)->update($data);

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
        $tabel = Review::find($id);
        if($tabel){
            $tabel->delete();
            return ["message" => "Data Review berhasil dihapus"];
        }else{
            return ["message" => "Data Review tidak ditemukan"];
        }
    }
}
