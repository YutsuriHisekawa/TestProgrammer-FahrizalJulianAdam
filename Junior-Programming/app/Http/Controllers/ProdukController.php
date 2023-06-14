<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Http;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('index');
    }

    /**
     * Summary of request
     * @return void
     */
    /**
     * Summary of data
     * @return mixed
     */
    public function data()
    {
        $produk = Produk::orderBy('id_produk', 'desc')
            //menampilkan data yang bisa dijual  saja.
            ->where('status', 'bisa dijual')
            ->get();
        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('id_produk', function ($produk) {
                return '<span class="badge bg-success">' . $produk->id_produk . '<span>';
            })
            ->addColumn('nama_produk', function ($produk) {
                return $produk->nama_produk;
            })
            ->addColumn('harga', function ($produk) {
                return 'Rp. ' . number_format($produk->harga);
            })
            ->addColumn('kategori', function ($produk) {
                return ($produk->kategori);
            })
            ->addColumn('status', function ($produk) {
                return ($produk->status);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="text-center">
                <div class="btn-group">
                <button type="button" onclick="editForm(`' . route('produk.update', $produk->id_produk) . '`)" class="btn btn-xs btn-success btn-flat"><i class="bi bi-gear"></i></button>
                <button type="button" onclick="deleteData(`' . route('produk.destroy', $produk->id_produk) . '`)" class="btn btn-xs btn-danger btn-flat"><i class="bi bi-trash"></i></button>
                </div>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'id_produk', 'select_all'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $produk = new Produk();
        $produk->nama_produk = $request->nama_produk;
        $produk->harga = $request->harga;
        $produk->kategori = $request->kategori;
        $produk->status = $request->status;
        $produk->save();
        return response()->json('Data berhasil disimpan', 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function import(Request $request)
    {
        $curl = curl_init();
        $url = "https://recruitment.fastprint.co.id/tes/api_tes_programmer";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        $data = array(
            'username' => 'tesprogrammer140623C18',
            'password' => md5('bisacoding-14-06-23'),
        );
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //execute request
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        //$response = curl_exec($curl);
        $data = json_decode($response);
        if ($data) {
            foreach ($data->data as $produk) {
                Produk::updateorCreate(
                    ['id_produk' => $produk->id_produk],
                    [
                        'id_produk' => $produk->id_produk,
                        'nama_produk' => $produk->nama_produk,
                        'harga' => $produk->harga,
                        'kategori' => $produk->kategori,
                        'status' => $produk->status,
                    ]
                );
            }
        }
        dd('data stored');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin:');
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $produk = Produk::find($id);
        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->update($request->all());

        return response()->json('Data tersimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     */public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return response(null, 204);
    }

}