<?php

namespace App\Http\Controllers;

use App\Models\Tapel;
use Illuminate\Http\Request;
use PDF;

class TapelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tapels=Tapel::all();
        return view('admin.tapels.index',compact('tapels'));
        // return view('admin.tapels.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         //
         $request->validate([
            'nama'=>'required'
            
        ],
        [
            'nama.required'=>'Nama harus diisi'

        ]);
            // dd($request);
        Tapel::create($request->all());
        return redirect('/tapel')->with('status','Data berhasil di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tapel  $tapel
     * @return \Illuminate\Http\Response
     */
    public function show(Tapel $tapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tapel  $tapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Tapel $tapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tapel  $tapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tapel $tapel)
    {
        //
        $request->validate([
            'nama'=>'required'
        ],
          
        [
            'nama.required'=>'Nama harus diisi'


        ]);
         //aksi update
      
        tapel::where('id',$tapel->id)
            ->update([
                'nama'=>$request->nama
            ]);
            return redirect('/tapel')->with('status','Data berhasil diupdate!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tapel  $tapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tapel $tapel)
    {
        //
        Tapel::destroy($tapel->id);
        return redirect('/tapel')->with('status','Data berhasil dihapus!');
    }

    public function cetak_pdf()
    {
    	$tapel = Tapel::all();
 
    	$pdf = PDF::loadview('admin.tapels.tapelpdf',['tapels'=>$tapel]);
    	return $pdf->download('laporan-tapel-pdf');
    }
}
