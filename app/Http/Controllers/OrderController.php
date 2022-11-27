<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabel = Order::all();

        return response()->json([
            "message" => "Orders",
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
            'date' => 'required|string',
            'alamat' => 'required|string'
        ]);

        $data = Order::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'date' => $request->date,
            'alamat' => $request->alamat
        ]);

        if ($data) {
            return response([
                'status' => 201,
                'message' => "Data Order berhasil ditambahkan",
                'data' => $data
            ]);
        }else {
            return response([
                'status' => 401,
                'message' => "Data Order gagal ditambahkan",
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
        $tabel = Order::find($id);
        if($tabel){
            return $tabel;
        }else{
            return ["message" => "Data Order tidak ditemukan"];
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
        $update = Order::where("id", $id)->update($data);

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
        $tabel = Order::find($id);
        if($tabel){
            $tabel->delete();
            return ["message" => "Data Order berhasil dihapus"];
        }else{
            return ["message" => "Data Order tidak ditemukan"];
        }
    }
}
