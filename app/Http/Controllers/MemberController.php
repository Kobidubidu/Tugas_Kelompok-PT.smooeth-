<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::latest()->paginate(10);
       return view("members.index", compact("members"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("members.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|min:5",
            "nis" => "required|numeric|min:10",
            "kelas" => "required|min:5",
            "image" => "required|image|mimes:jpeg,jpg,png|max:2048",
        ]); 
        $image = $request->file("image");
        $image->storeAs("members" , $image->hashName(), 'public');

        Member::create([
            'nama'=> $request->nama,
            "nis" => $request->nis,
            "kelas"=> $request->kelas,
            "image" => $image->hashName()
        ]);

        return redirect()->route("members.index")->with("success","data berhasil disimpan");


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $members = Member::findOrFail($id);
        
        return view("members.show", compact("members"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $members = Member::findOrFail($id);
        return view("members.edit", compact("members"));
    }

    /**
     * Update the speified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        "nama" => "required|max:255",
        "nis" => "required|numeric|min:10",
        "kelas" => "required|max:10",
        "image" => "image|mimes:jpeg,jpg,png|max:2048", // Tidak required karena bisa opsional
    ]);

    $member = Member::findOrFail($id);

    // Cek apakah ada gambar baru diupload
    if ($request->hasFile("image")) {
        $image = $request->file("image");
        $image->storeAs("members", $image->hashName(), "public");

        // Hapus gambar lama
        Storage::delete("public/members/" . $member->image);

        // Update dengan gambar baru
        $member->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'image' => $image->hashName(),
        ]);
    } else {
        // Update tanpa mengubah gambar
        $member->update([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
        ]);
    }

    return redirect()->route('members.index')->with('success', 'Data berhasil diubah');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Members = member::findOrFail($id);
        $Members->delete();
        return redirect()->route("members.index")->with("success", "data dihapus");
    }
}

