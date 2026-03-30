<?php

namespace App\Http\Controllers;

use App\Helpers\DummyHelper;
use App\Models\Barcode;
use App\Models\Staf;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\GroupUse;

class KelasController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $kelas = Kelas::query();
      return view('pages.kelas.index',[
        'kelas' => $kelas->get(),
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('pages.kelas.create',[
        'staf' => Staf::with('user')->get(),
      ]);
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
        'name' => 'required|unique:kelas,name',
        'tingkat' => 'required',
        'staf_id' => 'nullable|exists:staf,id',
      ]);

      Kelas::create($request->all());
      return redirect(route('kelas.index'))->withSuccess('Data berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Kelas $kelas)
  {
    abort(404);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Kelas $kelas)
  {
      return view('pages.kelas.edit',[
        'staf' => Staf::with('user')->get(),
        'kelas' => $kelas
      ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Kelas $kelas)
  {
      $request->validate([
        'name' => 'required|unique:kelas,name,' . $kelas->id,
        'tingkat' => 'required',
        'staf_id' => 'nullable|exists:staf,id',
      ]);
      $kelas->update($request->all());
      return redirect(route('kelas.index'))->withSuccess('Data berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Kelas $kelas)
  {
      $kelas->delete();
      return redirect(route('kelas.index'))->withSuccess('Data berhasil dihapus!');
  }
}
