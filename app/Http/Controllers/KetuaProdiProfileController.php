<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\KetuaProdiProfile;
    use App\Models\Prodi;
    use App\Models\DosenProfile;


    class KetuaProdiProfileController extends Controller
    {
        public function index()
{
    $profiles = KetuaProdiProfile::with('prodi')->get();
    return view('admin.kaprodi.dashboard', compact('profiles'));
}


        public function create()
    {
        $dosens = DosenProfile::all(); // Ambil semua data dosen
        $prodis = Prodi::all(); // Ambil semua data prodi
        return view('admin.kaprodi.create', compact('dosens', 'prodis'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'dosen_nik' => 'required|exists:dosen_profiles,nik',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $dosen = DosenProfile::where('nik', $request->dosen_nik)->first();

        $prodi = Prodi::find($request->prodi_id);

        KetuaProdiProfile::create([
            'nik' => $dosen->nik,
            'nama_dosen' => $dosen->name,

            'nama_prodi' => $prodi->nama_prodi,
            'tanggal_lahir' => $dosen->tanggal_lahir,
            'email' => $dosen->email,
            'password' => $dosen->password, // atau Hash::make(...), tergantung
            'prodi_id' => $prodi->id,
        ]);

        return redirect()->route('kaprodi.dashboard')->with('success', 'Data Ketua Prodi berhasil ditambahkan!');
    }





        public function edit($nik)
    {
        $kaprodi = KetuaProdiProfile::where('nik', $nik)->firstOrFail();
        $prodis = Prodi::all(); // Ambil semua data prodi

        return view('admin.kaprodi.edit', compact('kaprodi', 'prodis'));
    }


    public function update(Request $request, $nik)
    {
        // Validasi data
        $request->validate([
            'nama_dosen' => 'required',
            'email' => 'required|email',
            'tanggal_lahir' => 'required|date',
        ]);
        

        // Cek apakah data ditemukan
        $kaprodi = KetuaProdiProfile::where('nik', $nik)->first();
        if (!$kaprodi) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        // Perbarui data
        $kaprodi->update([
            'nama_dosen' => $request->name,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'prodi_id' => $request->prodi_id, // Pastikan ini ada
        ]);
        

        return redirect()->route('kaprodi.dashboard')->with('success', 'Data berhasil diperbarui');
    }




        public function destroy($nik)
        {
            $kaprodi = KetuaProdiProfile::where('nik', $nik)->firstOrFail();
            $kaprodi->delete();

            return redirect()->route('kaprodi.dashboard')->with('success', 'Data Kaprodi berhasil dihapus!');
        }



    }
