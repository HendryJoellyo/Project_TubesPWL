<?php

            namespace App\Http\Controllers;

            use Illuminate\Http\Request;
            use App\Models\DosenProfile;
            use Illuminate\Support\Facades\Log;
            use Illuminate\Support\Facades\DB;
            class DosenProfileController extends Controller
            {
                public function index()
                {
                    $dosens = DosenProfile::all();
                    return view('admin.dosen.index', compact('dosens'));
                }

                public function create()
                {
                    return view('admin.dosen.create_dosen');
                }

                public function store(Request $request)
                {
                    Log::info('Request data:', $request->all()); // Tambahkan log ini
                
                    $request->validate([
                        'nik' => 'required|unique:dosen_profiles,nik',
                        'name' => 'required',
                        'tanggal_lahir' => 'required|date',
                        'email' => 'required|email|unique:dosen_profiles,email',
                        'password' => 'required|confirmed|min:6',
                    ]);
                
                    $dosen = DosenProfile::create([
                        'nik' => $request->nik,
                        'name' => $request->name,
                        'tanggal_lahir' => $request->tanggal_lahir,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ]);
                
                    Log::info('Data berhasil disimpan:', $dosen->toArray()); // Log hasil penyimpanan
                
                    return redirect()->route('admin.dosen.index')->with('success', 'Dosen berhasil ditambahkan');
                }

                        

            public function edit($nik)
            {
                $dosen = DosenProfile::where('nik', $nik)->firstOrFail();
                return view('admin.dosen.edit_dosen', compact('dosen'));
            }

            public function update(Request $request, $nik)
            {
                $dosen = DosenProfile::where('nik', $nik)->firstOrFail();
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:dosen_profiles,email,' . $nik . ',nik',

                    'tanggal_lahir' => 'required|date',
                    'password' => 'nullable|min:6|confirmed',
                ]);

                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'tanggal_lahir' => $request->tanggal_lahir,
                ];

                if ($request->filled('password')) {
                    $data['password'] = bcrypt($request->password);
                }

                $dosen->update($data);

                return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui');
            }

    public function destroy($nik)
    {
        $dosen = DosenProfile::where('nik', $nik)->firstOrFail();
        $dosen->delete();
        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil dihapus!');
    }

            }
