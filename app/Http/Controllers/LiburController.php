<?php

namespace App\Http\Controllers;

use App\Helpers\DummyHelper;
use App\Models\Barcode;
use App\Models\Libur;
use App\Models\User;
use Illuminate\Http\Request;

class LiburController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $libur = Libur::query();
      return view('pages.libur.index',[
        'libur' => $libur->get(),
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('pages.libur.create');
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
        'tanggal' => 'required|date|unique:liburs,tanggal',
        'keterangan' => 'required',
      ]);

      Libur::create($request->all());
      return redirect(route('libur.index'))->withSuccess('Data berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Libur $libur)
  {
    abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Libur $libur)
  {
      return view('pages.libur.edit', compact('libur'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Libur $libur)
  {
      $request->validate([
        'tanggal' => 'required|date|unique:liburs,tanggal,' . $libur->id,
        'keterangan' => 'required',
      ]);
      $libur->update($request->all());
      return redirect(route('libur.index'))->withSuccess('Data berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Libur $libur)
  {
      $libur->delete();
      return redirect(route('libur.index'))->withSuccess('Data berhasil dihapus!');
  }
}
