<?php

namespace App\Http\Controllers;

use App\Models\Mine;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TambangController extends Controller
{ 

    public function index()
    {

        $query = Mine::latest();
        if (request('search')) {
            $query->where('nama', 'like', '%' . request('search') . '%')
                ->orWhere('sinopsis', 'like', '%' . request('search') . '%');
        }
        $mines = $query->paginate(6)->withQueryString();
        return view('homepage', compact('mines'));
    }

    public function detail($id)
    {
        $mine= Mine::find($id);
        return view('detail', compact('mine'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('input', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'id' => ['required', 'string', 'max:255', Rule::unique('mine', 'id')],
            'nama' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'penemu' => 'required|string',
            'foto_sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // Jika validasi gagal, kembali ke halaman input dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect('mines/create')
                ->withErrors($validator)
                ->withInput();
        }

        $randomName = Str::uuid()->toString();
        $fileExtension = $request->file('foto_sampul')->getClientOriginalExtension();
        $fileName = $randomName . '.' . $fileExtension;

        // Simpan file foto ke folder public/images
        $request->file('foto_sampul')->move(public_path('images'), $fileName);
        // Simpan data ke table movies
        Mine::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'category_id' => $request->category_id,
            'sinopsis' => $request->sinopsis,
            'tahun' => $request->tahun,
            'penemu' => $request->penemu,
            'foto_sampul' => $fileName,
        ]);

        return redirect('/')->with('success', 'Data berhasil disimpan');
    }

    public function data()
    {
        $mines = Mine::latest()->paginate(10);
        return view('data-mines', compact('mines'));
    }

    public function edit($id)
    {
        $mine = Mine::find($id);
        $categories = Category::all();
        return view('form-edit', compact('mine', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'sinopsis' => 'required|string',
            'tahun' => 'required|integer',
            'penemu' => 'required|string',
            'foto_sampul' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Jika validasi gagal, kembali ke halaman edit dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect("/mines/edit/{$id}")
                ->withErrors($validator)
                ->withInput();
        }

        // Ambil data movie yang akan diupdate
        $mine = Mine::findOrFail($id);

        // Jika ada file yang diunggah, simpan file baru
        if ($request->hasFile('foto_sampul')) {
            $randomName = Str::uuid()->toString();
            $fileExtension = $request->file('foto_sampul')->getClientOriginalExtension();
            $fileName = $randomName . '.' . $fileExtension;

            // Simpan file foto ke folder public/images
            $request->file('foto_sampul')->move(public_path('images'), $fileName);

            // Hapus foto lama jika ada
            if (File::exists(public_path('images/' . $mine->foto_sampul))) {
                File::delete(public_path('images/' . $mine->foto_sampul));
            }

            // Update record di database dengan foto yang baru
            $mine->update([
                'nama' => $request->nama,
                'sinopsis' => $request->sinopsis,
                'category_id' => $request->category_id,
                'tahun' => $request->tahun,
                'penemu' => $request->penemu,
                'foto_sampul' => $fileName,
            ]);
        } else {
            // Jika tidak ada file yang diunggah, update data tanpa mengubah foto
            $mine->update([
                'nama' => $request->nama,
                'sinopsis' => $request->sinopsis,
                'category_id' => $request->category_id,
                'tahun' => $request->tahun,
                'penemu' => $request->penemu,
            ]);
        }

        return redirect('/mines/data')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $mine = Mine::findOrFail($id);

        // Delete the movie's photo if it exists
        if (File::exists(public_path('images/' . $mine->foto_sampul))) {
            if ($mine->foto_sampul != 'default.jpg') {
                File::delete(public_path('images/' . $mine->foto_sampul));
            }
        }

        // Delete the movie record from the database
        $mine->delete();

        return redirect('/mines/data')->with('success', 'Data berhasil dihapus');
    }
}
