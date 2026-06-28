<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        return response()->json(Destination::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'province' => 'required|string|max:100',
            'description' => 'required',
            'image_url' => 'nullable|string',
        ]);

        $destination = Destination::create($request->all());
        return response()->json($destination, 201);
    }

    public function show(Destination $destination)
    {
        return response()->json($destination);
    }

    public function update(Request $request, Destination $destination)
    {
        $destination->update($request->all());
        return response()->json($destination);
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return response()->json(['message' => 'Destination berhasil dihapus.']);
    }
}
