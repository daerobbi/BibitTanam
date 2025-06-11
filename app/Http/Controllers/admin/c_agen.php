<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agen;

class c_agen extends Controller
{
    public function agen(Request $request)
    {
        $search = $request->input('search');

        $query = Agen::whereHas('user', function ($q) {
            $q->where('status_akun', 1);
        });

        if ($search) {
            $query->where('nama', 'like', '%' . $search . '%');
        }

        $agens = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.v_agen', compact('agens', 'search'));
    }

    public function detail($id)
    {
        $agen = Agen::with('user')->findOrFail($id);
        return view('admin.v_detailakunagen', compact('agen'));
    }
}
