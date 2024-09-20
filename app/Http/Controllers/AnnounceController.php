<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announces = Announce::all()->where('status', 'equal', 'pending');
        return response()->json($announces);
    }

    public function acceptAnnounce($id)
    {
        $announce = Announce::find($id);
        $announce->status = 'accepted';
        $announce->save();
        return response()->json($announce);
    }

    public function declineAnnounce($id)
    {
        $announce = Announce::find($id);
        $announce->status = 'declined';
        $announce->save();
        return response()->json($announce);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $announce = Announce::create($request->only(['title', 'description', 'location']));

        foreach ($request->file('image') as $image) {
            $announce->images()->create([
                'image' => $image->store('images/announces')
            ]);
        }

        return response()->json($announce);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announce $announceRequest)
    {
        $announceRequest->update($request->only(['title', 'description', 'location']));

        return response()->json($announceRequest);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announce $announceRequest)
    {
        $announceRequest->delete();
        return response()->json($announceRequest);
    }
}
