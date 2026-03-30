<?php

namespace App\Http\Controllers;

use App\Models\Staf;
use App\Models\User;
use App\Models\Barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StafController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('admin');

        return view('pages.staf.index', [
            'staf' => Staf::with('user')->get(),
        ]);
    }

    public function create()
    {
        $this->authorize('admin');
        return view('pages.staf.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'jk'        => 'required',
            'jabatan'   => 'required', // ✅ TAMBAH
            'telepon'   => 'nullable',
            'alamat'    => 'nullable',
            'nip'       => 'nullable|unique:staf,nip',
            'username'  => 'required|unique:users,username',
            'password'  => 'required',
        ]);

        // Buat user
        $userData = $request->only([
            'name',
            'jk',
            'jabatan', // ✅ TAMBAH
            'telepon',
            'alamat',
            'username'
        ]);

        $userData['role'] = 'staf';
        $userData['idt'] = Str::uuid();
        $userData['password'] = bcrypt($request->password);

        $user = User::create($userData);

        // Buat data staf
        Staf::create([
            'user_id' => $user->id,
            'nip'     => $request->nip,
        ]);

        return redirect(route('staf.index'))
            ->withSuccess('Data berhasil ditambahkan!');
    }

    public function show(Request $request, Staf $staf)
    {
        $staf->load('user');

        $barcode = Barcode::first();

        return view('pages.staf.show', compact('staf','barcode'));
    }

    public function edit(Staf $staf)
    {
        $this->authorize('admin');
        $staf->load('user');
        return view('pages.staf.edit', compact('staf'));
    }

    public function update(Request $request, Staf $staf)
    {
        $request->validate([
            'name'      => 'required',
            'jk'        => 'required',
            'jabatan'   => 'required', // ✅ TAMBAH
            'telepon'   => 'nullable',
            'alamat'    => 'nullable',
            'nip'       => 'nullable|unique:staf,nip,' . $staf->id,
            'username'  => 'required|unique:users,username,' . $staf->user_id,
            'password'  => 'nullable',
        ]);

        // Update data staf
        $staf->update([
            'nip' => $request->nip,
        ]);

        // Update data user
        $userData = $request->only([
            'name',
            'jk',
            'jabatan', // ✅ TAMBAH
            'telepon',
            'alamat',
            'username'
        ]);

        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }

        $staf->user->update($userData);

        return redirect(route('staf.index'))
            ->withSuccess('Data berhasil diperbarui!');
    }

    public function destroy(Staf $staf)
    {
        $staf->user->delete();

        return redirect(route('staf.index'))
            ->withSuccess('Data berhasil dihapus!');
    }
}
