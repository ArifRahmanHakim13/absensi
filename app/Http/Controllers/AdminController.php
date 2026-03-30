<?php

namespace App\Http\Controllers;

use App\Helpers\DummyHelper;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
      $admin = Admin::query();
      return view('pages.admin.index',[
        'admin' => $admin->with('user')->get(),
      ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('pages.admin.create');
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
        'name' => 'required',
        'jk' => 'required',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
        'username' => 'required|unique:users,username',
        'password' => 'required',
      ]);

      $request['idt'] = DummyHelper::idt();
      $request['role'] = 'admin';
      $user = User::create($request->all());

      $request['user_id'] = $user->id;
      Admin::create($request->only('user_id'));

      return redirect(route('admin.index'))->withSuccess('Data berhasil ditambahkan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Admin $admin)
  {
    $admin->load('user');
    return view('pages.admin.show', compact('admin'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Admin $admin)
  {
      $admin->load('user');
      return view('pages.admin.edit', compact('admin'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Admin $admin)
  {
      $request->validate([
        'name' => 'required',
        'jk' => 'required',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
        'username' => 'required|unique:users,username,' . $admin->user_id,
        'password' => 'nullable',
      ]);

      filled($request->password) ? $admin->user->update($request->all())
                                 : $admin->user->update($request->except('password'));

      return redirect(route('admin.index'))->withSuccess('Data berhasil diperbarui!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Admin $admin)
  {
      $admin->user->delete();
      return redirect(route('admin.index'))->withSuccess('Data berhasil dihapus!');
  }
}
