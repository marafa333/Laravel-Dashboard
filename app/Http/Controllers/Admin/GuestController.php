<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GuestController extends Controller
{
    // Display a listing of guests
    public function index()
    {
        $guests = DB::select('select * from guests');
        return view('admin.guests.index', [
            'user' => auth()->user(),
            'guests' => $guests,
        ]);
    }

    // Show the form for creating a new guest
    public function create()
    {
        return view('admin.guests.create', [
            'user' => auth()->user(),
        ]);
    }

    // Store a newly created Guest in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'age' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|string|max:100',
            'password' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/guests'), $imageName);
            $imagePath = 'uploads/guests/' . $imageName;
        }
        $hashedPassword = $request->password ? bcrypt($request->password) : null;
        Guest::create([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $hashedPassword,
            'image' => $imagePath,
        ]);

        return redirect()->route('guests.index')->with('success', 'Guest created successfully.');
    }


    // Display the specified guest
    public function show(Guest $guest)
    {
        return view('admin.guests.show', [
            'user' => auth()->user(),
            'guest' => $guest,
        ]);
    }

    // Show the form for editing the specified guest
    public function edit(Guest $guest)
    {
        return view('admin.guests.edit', [
            'user' => auth()->user(),
            'guest' => $guest,
        ]);
    }

    // Update the specified guest in storage
    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'age' => 'nullable|string|max:50',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|string|max:100',
            'password' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($guest->image && file_exists(public_path($guest->image))) {
                unlink(public_path($guest->image));
            }

            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/guests'), $imageName);
            $guest->image = 'uploads/guests/' . $imageName;
        }
        $hashedPassword = $request->password ? bcrypt($request->password) : $guest->password;
        $guest->update([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $hashedPassword,
        ]);

        return redirect()->route('guests.index')->with('edit', 'guest updated successfully.');
    }


    // Remove the specified guest from storage
    public function destroy(Guest $guest)
    {
        if (File::exists(public_path('uploads/' . $guest->image))) {
            File::delete(public_path('uploads/' . $guest->image));
        }

        $guest->delete();

        return redirect()->route('guests.index')->with('delete', 'Guest deleted successfully.');
    }
}