<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProfilController extends Controller
{
  public function index() {
    if (Auth::user()->isAdmin()) {
      $saya = Auth::user()->admin;
    } elseif (Auth::user()->isStaf()) {
      $saya = Auth::user()->staf;
    } else {
      $saya = Auth::user()->kapus;
    }

    return view('pages.profil.index', [
      'title' => 'Profil Saya',
      'saya' => $saya
    ]);
  }

  public function editFoto() {
    if (Auth::user()->isAdmin()) {
      $saya = Auth::user()->admin;
    } elseif (Auth::user()->isStaf()) {
      $saya = Auth::user()->staf;
    } else {
      $saya = Auth::user()->kapus;
    }

    return view('pages.profil.editfoto', [
      'title' => 'Edit Foto Profil',
      'saya' => $saya
    ]);
  }

  public function editAkun() {
    if (Auth::user()->isAdmin()) {
      $saya = Auth::user()->admin;
    } elseif (Auth::user()->isStaf()) {
      $saya = Auth::user()->staf;
    } else {
      $saya = Auth::user()->kapus;
    }

    return view('pages.profil.editakun', [
      'title' => 'Edit Akun',
      'saya' => $saya,
    ]);
  }

  public function update(Request $request, $id) {
    $this->validasiUpdateProfil($request);

    return back()->withSuccess('Profil Anda berhasil diperbarui!');
  }

  public function updatePhoto(Request $request) {
    $request->validate([
      'files' => ['image', 'required'],
    ]);

    $files = $request->file('files');
    if ($request->hasFile('files')) {
      $extension = $files->getClientOriginalExtension();
      $filenamesimpan = 'img' . time() . Auth::id() . Str::random(10) . '.' . $extension;
      $files->move('img/fotoprofil/', $filenamesimpan);

      $editdata = [
        'foto' => $filenamesimpan,
      ];

      if (Auth::user()->foto != 'profile.jpg') {
        $filegambar = public_path('/img/fotoprofil/' . Auth::user()->foto);
        File::delete($filegambar);
      }

      Auth::user()->update($editdata);
    }

    return back()->with([
      'success' => 'Foto profil berhasil diperbarui!',
    ]);
  }

  public function updateAkun(Request $request, $id) {
    $akun = User::find($id);

    $request->validate([
      'username' => 'required|unique:users,username,' . $akun->id,
      // 'email' => 'required|unique:users,email,' . $akun->id,
    ]);

    if ($request->filled('password')) {
      $akun->update($request->all());
    } else {
      $akun->update($request->except('password'));
    }

    return back()->withSuccess('Data Akun berhasil diperbarui!');
  }

  private function validasiUpdateProfil($request) {
    if (Auth::user()->isAdmin()) {
      $request->validate([
        'name' => 'required',
        'jk' => 'required',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
      ]);

      Auth::user()->update($request->only('name', 'jk', 'telepon', 'alamat'));

    } elseif (Auth::user()->isStaf()) {
      $request->validate([
        'name' => 'required',
        'jk' => 'required',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
        'nip' => 'nullable|unique:staf,nip,' . $request->id,
      ]);

      Auth::user()->staf->update($request->only('nip'));
      Auth::user()->update($request->only('name', 'jk', 'telepon', 'alamat'));

    } else {
      $request->validate([
        'name' => 'required',
        'jk' => 'required',
        'telepon' => 'nullable',
        'alamat' => 'nullable',
        'nip' => 'nullable|unique:kapus,nip,' . $request->id,
      ]);

      Auth::user()->update($request->only('name', 'jk', 'telepon', 'alamat'));
      Auth::user()->kapus->update($request->only('nip'));
    }
  }
}
