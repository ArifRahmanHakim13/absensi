<?php

namespace App\Http\Controllers;

use App\Helpers\DummyHelper;
use App\Models\Barcode;
use App\Models\Tapel;
use App\Models\User;
use Illuminate\Http\Request;

class TapelController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $tapel = Tapel::query();
      return view('pages.tapel.index',[
        'tapel' => $tapel->get(),
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('pages.tapel.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $request->validate([
        'tahun' => 'required',
        'periode' => 'required',
        'mulai' => 'required|date',
        'selesai' => [
          'required',
          'date',
          function ($attribute, $value, $fail) use ($request) {
              $mulai = $request->input('mulai');
              if (strtotime($value) <= strtotime($mulai)) {
                  $fail('Tanggal selesai harus setelah tanggal mulai.');
              }
          },
        ],
        'is_aktif' => 'required',
      ]);

      if ($request->is_aktif == '1') Tapel::where('is_aktif', 1)->update([ 'is_aktif' => 0 ]);
      Tapel::create($request->all());
      return redirect(route('tapel.index'))->withSuccess('Data berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Tapel $tapel)
  {
    abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Tapel $tapel)
  {
      return view('pages.tapel.edit', compact('tapel'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Tapel $tapel)
  {
      $request->validate([
        'tahun' => 'required',
        'periode' => 'required',
        'mulai' => 'required|date',
        'selesai' => [
          'required',
          'date',
          function ($attribute, $value, $fail) use ($request) {
              $mulai = $request->input('mulai');
              if (strtotime($value) <= strtotime($mulai)) {
                  $fail('Tanggal selesai harus setelah tanggal mulai.');
              }
          },
        ],
        'is_aktif' => 'required',
      ]);

      if ($request->is_aktif == '1') Tapel::where('is_aktif', 1)->where('id', '!=', $tapel->id)->update([ 'is_aktif' => 0 ]);
      $tapel->update($request->all());
      return redirect(route('tapel.index'))->withSuccess('Data berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Tapel $tapel)
  {
      $tapel->delete();
      return redirect(route('tapel.index'))->withSuccess('Data berhasil dihapus!');
  }
}
