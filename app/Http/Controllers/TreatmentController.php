<?php

namespace App\Http\Controllers;

use App\Treatment;
use Illuminate\Support\Facades\Cache;

class TreatmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['add']);
        $this->middleware('can:admin-panel')->except(['add']);
    }

    public function index()
    {
        $treatments = Cache::tags('treatment')->remember('treatmentList', 3600, function () {
            return Treatment::latest('created_at')->get();
        });

        return view('admin.treatment', compact('treatments'));
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
