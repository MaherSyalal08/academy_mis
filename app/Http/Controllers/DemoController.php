<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function index(){
        $asisten = 'John Doe'; 
        $mahasiswas = ['Maher', 'Marco', 'Syehan'];

        return view('demo.file2', [
            'asdos' => $asisten, 
        ])-> with('students', $mahasiswas);
    }
}
