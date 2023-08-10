<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\User;

class ProfileControllerAdmin extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view("pages.admin.profile.index", [
            "user" => $user,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $item = Auth::user();

        if ($request->password) {
            $data["password"] = bcrypt($request->password);
        } else {
            unset($data["password"]);
        }

        $item->update($data);

        return redirect()->route("pages.admin.profile.index");
    }
}
