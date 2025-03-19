<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return(view('mahasiswa.index') 
            ->with('mahasiswas', Mahasiswa::all()));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('mahasiswa.create')
            ->with('dosens', Dosen::all()); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(),[
            'nrp' => 'required|string|max:9|unique:mahasiswa,nrp',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:50|unique:mahasiswa,email',
            'birth_date' => 'required|date',
            'address' => 'required|string|max:300', 
            'phone' => 'required|string|max:16',
            'dosen_nik' => 'required|string',
        ])->validate();
        $mahasiswa = new Mahasiswa($validatedData);
        $mahasiswa->save();
        return redirect(route('mahasiswaList'));
    }



    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
