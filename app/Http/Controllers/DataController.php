<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;

class DataController extends Controller
{
    public function store(Request $request)
    {
        $data = new Data();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->tanggal_lahir = $request->tanggal_lahir;
        $data->prodi_id = $request->prodi_id;
        $data->save();

        return redirect()->route('index')->with('success', 'Data successfully created');
    }
}
