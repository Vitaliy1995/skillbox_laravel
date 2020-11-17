<?php

namespace App\Http\Controllers;

use App\Treatment;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        $treatments = Treatment::latest('created_at')->get();

        return view('admin.index', compact('treatments'));
    }

    public function add()
    {
        $validatedData = $this->validate(\request(), [
            "email" => "email:rfc,dns|required",
            "message" => "required",
        ]);

        Treatment::create($validatedData);

        return redirect(route('contacts'));
    }
}
