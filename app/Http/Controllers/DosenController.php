<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return(view('dosen.index')
            ->with('dosens', Dosen::all()));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return(view('dosen.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = validator($request->all(),[
            'nik' => 'required|string|max:7|unique:dosen,nik',
            'name' => 'required|string|max:45',
            'email' => 'required|string|email|max:50|unique:dosen,email',
            'birth_date' => 'required|date',
        ])->validate();

        $dosen = new Dosen($validatedData);
        $dosen->save();
        return redirect(route('dosenList'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit')->with('dosen', $dosen);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        $validatedData = validator($request->all(),[
            'nik' => 'required', 'string', 'max:7', Rule::unique('dosen', 'nik')->ignore($dosen->nik, 'nik'),
            'name' => 'required|string|max:45',
            'email' => 'required', 'string', 'email', Rule::unique('dosen', 'email')->ignore($dosen->email, 'email'),
            'birth_date' => 'required|date',
        ])->validate();

        $dosen['name'] = $validatedData['name'];
        $dosen['email'] = $validatedData['email'];
        $dosen['birth_date'] = $validatedData['birth_date'];
        $dosen->save();
        return redirect(route('dosenList'))->with('success', 'Dosen berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect(route('dosenList'))->with('success', 'Dosen berhasil dihapus');
    }
}
