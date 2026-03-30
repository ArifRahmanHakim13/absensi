<?php

namespace App\Http\Controllers;

use App\Helpers\DummyHelper;
use App\Models\Kapus;
use App\Models\User;
use Illuminate\Http\Request;

class KapusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('pages.kapus.index', [
            'kapus' => Kapus::with('user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kapus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'jk'        => 'required',
            'telepon'   => 'nullable',
            'alamat'    => 'nullable',
            'nip'       => 'nullable|unique:kapus,nip',
            'username'  => 'required|unique:users,username',
            'password'  => 'required',
        ]);

        // tambahkan kolom otomatis
        $request['idt']  = DummyHelper::idt();
        $request['role'] = 'kapus';

        // buat user (batasi field agar tidak memasukkan field tak terduga)
        $user = User::create([
            'name'     => $request->name,
            'jk'       => $request->jk,
            'telepon'  => $request->telepon,
            'alamat'   => $request->alamat,
            'username' => $request->username,
            'password' => $request->password,
            'role'     => $request->role,
            'idt'      => $request->idt,
        ]);

        // buat kapus
        Kapus::create([
            'user_id' => $user->id,
            'nip'     => $request->nip,
        ]);

        return redirect()->route('kapus.index')->withSuccess('Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kapus = Kapus::with('user')->findOrFail($id);
        return view('pages.kapus.show', compact('kapus'));
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit($id)
    {
        $kapus = Kapus::with('user')->findOrFail($id);
        return view('pages.kapus.edit', compact('kapus'));
    }

    /**
     * Update the resource.
     */
    public function update(Request $request, $id)
    {
        $kapus = Kapus::findOrFail($id);

        $request->validate([
            'name'      => 'required',
            'jk'        => 'required',
            'telepon'   => 'nullable',
            'alamat'    => 'nullable',
            'nip'       => 'nullable|unique:kapus,nip,' . $kapus->id,
            'username'  => 'required|unique:users,username,' . $kapus->user_id,
            'password'  => 'nullable',
        ]);

        // update kapus
        $kapus->update([
            'nip' => $request->nip,
        ]);

        // prepare data untuk user update
        $dataUser = [
            'name'    => $request->name,
            'jk'      => $request->jk,
            'telepon' => $request->telepon,
            'alamat'  => $request->alamat,
            'username'=> $request->username,
        ];

        if ($request->filled('password')) {
            $dataUser['password'] = $request->password;
        }

        $kapus->user->update($dataUser);

        return redirect()->route('kapus.index')->withSuccess('Data berhasil diperbarui!');
    }

    /**
     * Remove the resource.
     */
    public function destroy($id)
    {
        $kapus = Kapus::findOrFail($id);
        $kapus->user->delete();
        return redirect()->route('kapus.index')->withSuccess('Data berhasil dihapus!');
    }
}
