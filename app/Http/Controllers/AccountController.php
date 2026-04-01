<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function accountpanel()
    {
        $user = DB::table("users")
            ->whereRaw("id = ?", [Auth::user()->id])
            ->first();

        return view("vidusach.account", compact("user"));
    }
    public function saveaccountinfo(Request $request)
    {
        $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:15'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ]);

        $id = $request->input('id');

        $data = [
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ];

        if ($request->hasFile('photo')) {
            $fileName = Auth::user()->id . '.' . $request->file('photo')->extension();

            $request->file('photo')->storeAs('public/profile', $fileName);

            $data['photo'] = $fileName;
        }

        DB::table("users")->where("id", $id)->update($data);

        return redirect()
            ->route('account')
            ->with('status', 'Cập nhật thông tin thành công!');
    }
}