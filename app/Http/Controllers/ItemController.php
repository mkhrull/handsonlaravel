<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ItemController extends Controller
{
    public function edit(int $id)
    {
        $data = User::findOrFail($id);
        return view('edit', ['data' => $data]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phonenum' => 'required',
            'address' => 'nullable',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
        ]);

        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/admindashboard/';
            $file->move($path, $filename);
            $user->image = $path . $filename;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phonenum = $request->input('phonenum');
        $user->address = $request->input('address');
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function delete(int $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect(route('admindashboard'))->with('status', 'User deleted :(');
    }
}