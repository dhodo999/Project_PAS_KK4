<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tabel = Payment::all();

        return response()->json([
            "message" => "Payments",
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
            'metode' => 'required|string',
            'total' => 'required|integer'
        ]);

        $data = Payment::create([
            'metode' => $request->metode,
            'total' => $request->total
        ]);

        if ($data) {
            return response([
                'status' => 201,
                'message' => "Data Payment berhasil ditambahkan",
                'data' => $data
            ]);
        }else {
            return response([
                'status' => 401,
                'message' => "Data Payment gagal ditambahkan",
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
        $tabel = Payment::find($id);
        if($tabel){
            return $tabel;
        }else{
            return ["message" => "Data Payment tidak ditemukan"];
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
        $update = Payment::where("id", $id)->update($data);

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
        $tabel = Payment::find($id);
        if($tabel){
            $tabel->delete();
            return ["message" => "Data Payment berhasil dihapus"];
        }else{
            return ["message" => "Data Payment tidak ditemukan"];
        }
    }
}
