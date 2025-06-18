<?php

namespace App\Http\Controllers;

use App\Models\Ijin;
use Illuminate\Http\Request;

class IjinApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $ijins = Ijin::with([
            'santri:id,wali_id,nama',
            'santri.wali:id,user_id',
            'santri.wali.user:id,name'
        ])
            ->whereHas('santri.wali.user', function ($query) use ($userId) {
                $query->where('id', $userId);
            })
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $ijins,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'santri_id' => 'required|exists:santris,id',
            'alasan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $ijin = Ijin::create($validated);

        return response()->json([
            'status' => 'success',
            'data' => $ijin,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ijin $ijin)
    {
        // Pastikan wali hanya bisa lihat ijin miliknya
        if ($ijin->santri->wali->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'status' => 'success',
            'data' => $ijin->load('santri'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ijin $ijin)
    {
        if ($ijin->santri->wali->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'alasan' => 'sometimes|required|string|max:255',
            'tanggal_mulai' => 'sometimes|required|date',
            'tanggal_selesai' => 'sometimes|required|date|after_or_equal:tanggal_mulai',
        ]);

        $ijin->update($validated);

        return response()->json([
            'status' => 'success',
            'data' => $ijin,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ijin $ijin)
    {
        if ($ijin->santri->wali->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $ijin->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Ijin deleted',
        ]);
    }
}
