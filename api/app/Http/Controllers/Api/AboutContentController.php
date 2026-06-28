<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutContent;
use Illuminate\Http\Request;

class AboutContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(AboutContent::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string|max:50|unique:about_contents',
            'title' => 'required|string|max:200',
            'body' => 'required|string',
            'image_url' => 'nullable|string',
        ]);

        $content = AboutContent::create($request->all());
        return response()->json($content, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutContent $aboutContent)
    {
        return response()->json($aboutContent);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutContent $aboutContent)
    {
        $aboutContent->update($request->all());
        return response()->json($aboutContent);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutContent $aboutContent)
    {
        $aboutContent->delete();
        return response()->json(['message' => 'Konten tentang berhasil dihapus.']);
    }
}
