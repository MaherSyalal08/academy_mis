<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.index')
            ->with('mahasiswas', Mahasiswa::all());
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
        'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'name' => 'required|string|max:100',
        'email' => 'required|string|email|max:50|unique:mahasiswa,email',
        'birth_date' => 'required|date',
        'address' => 'required|string|max:300',
        'phone' => 'required|string|max:16',
        'dosen_nik' => 'required|string',
      ])->validate();
      $mahasiswa = new Mahasiswa($validatedData);

      if($request->hasFile('profile_picture')){
        $newFileName = $validatedData['nrp'] . '.' . $request->file('profile_picture')
        ->getClientOriginalExtension();
        $request->file('profile_picture')->storeAs('uploads', $newFileName);
        $mahasiswa['profile_picture'] = $newFileName;
      }
      $mahasiswa->save();
      return redirect(route('mahasiswaList'))->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nrp)
    {
      $student = Mahasiswa::find($nrp);
      if ($student == null) {
        return back()->withErrors(['err_msg' => 'Student not found!']);
      }
      return view('mahasiswa.detail')
        ->with('mahasiswa', $student);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nrp)
    {
      $student = Mahasiswa::find($nrp);
      if ($student == null) {
        return back()->withErrors(['err_msg' => 'Student not found!']);
      }
      return view('mahasiswa.edit')
        ->with('dosens', Dosen::all())
        ->with('mahasiswa', $student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nrp)
    {
      $student = Mahasiswa::find($nrp);

      if ($student == null) {
        return back()->withErrors(['err_msg' => 'Student not found!']);
      }
      $validatedData = $request->validate([
        'nrp' => ['required', 'string', 'max:9', Rule::unique('mahasiswa', 'nrp')->ignore($student->nrp, 'nrp')],
        'name' => ['required', 'string', 'max:100'],
        'birth_date' => ['required'],
        'phone' => ['required', 'numeric'],
        'email' => ['nullable', 'email', 'max:50', Rule::unique('mahasiswa', 'email')->ignore($student->nrp, 'nrp')],
        'address' => ['required', 'string', 'max:300'],
        'dosen_nik' => ['required', 'string'],
        'profile_picture' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
      ]);
      $student['name'] = $validatedData['name'];
      $student['birth_date'] = $validatedData['birth_date'];
      $student['phone'] = $validatedData['phone'];
      $student['email'] = $validatedData['email'];
      $student['address'] = $validatedData['address'];
      $student['dosen_nik'] = $validatedData['dosen_nik'];
      if($request->hasFile('profile_picture')){
        if($student['profile_picture'] != null){
          unlink('storage/uploads/' . $student->profile_picture);
        }
        $file = $request->file('profile_picture');
        $newFileName = $validatedData['nrp'] . '.' . $file->getClientOriginalExtension();
        $file->storePubliclyAs('uploads', $newFileName);
        $student['profile_picture'] = $newFileName;

      }
      $student->save();
      return redirect()->route('mahasiswaList')
        ->with('status', 'Student successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nrp)
    {
      $student = Mahasiswa::find($nrp);
      if ($student == null) {
        return back()->withErrors(['err_msg' => 'Student not found!']);
      }
      $student->delete();
      return redirect()->route('mahasiswaList')
        ->with('status', 'Student successfully deleted!');
    }
}
