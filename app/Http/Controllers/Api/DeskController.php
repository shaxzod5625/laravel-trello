<?php

namespace App\Http\Controllers\Api;

use App\Models\Desk;
use App\Http\Requests\StoreDeskRequest;
use App\Http\Resources\DeskResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DeskResource::collection(Desk::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeskRequest $request)
    {
        $validated = $request->validated();
        $desk = Desk::create($validated);
        return new DeskResource($desk);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $desk = Desk::with('lists')->find($id);
        if (!$desk) {
            return response()->json([
                'message' => 'Desk not found'
            ], 404);
        }
        return new DeskResource($desk);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDeskRequest $request, $id)
    {
        $validated = $request->validated();
        $desk = Desk::find($id);
        if (!$desk) {
            return response()->json([
                'message' => 'Desk not found'
            ], 404);
        }
        $desk->update($validated);
        return new DeskResource($desk);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $desk = Desk::find($id);
        if (!$desk) {
            return response()->json([
                'message' => 'Desk not found'
            ], 404);
        }
        $desk->delete();
        return response()->json([
            'message' => 'Desk deleted'
        ], 200);
    }
}
