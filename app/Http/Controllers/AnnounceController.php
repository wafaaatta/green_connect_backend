<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnounceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announces = Announce::whereNotIn('status', ['rejected'])
            ->orderByRaw('FIELD(status, "pending", "accepted")')
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($announces);
    }

    public function getAcceptedAnnounces(Request $request)
    {
        $announces = Announce::where('status', 'accepted')
            ->with('user')
            ->get();
        return response()->json($announces);
    }

    public function getUserAnnounces(Request $request)
    {
        $user = $request->user();
        $announces = Announce::where('user_id', $user->id)->get();
        return response()->json($announces);
    }

    public function acceptAnnounce(Request $request, $id)
    {
        $announce = Announce::find($id);
        $announce->status = 'accepted';
        $announce->save();
        return response()->json($announce);
    }

    public function declineAnnounce(Request $request, $id)
    {
        $announce = Announce::find($id);
        $announce->status = 'rejected';
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
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $request->user();

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/announces'), $imageName);

        $announce = Announce::create([
            'title' => $request->title,
            'description' => $request->description,
            'country' => $request->country,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'user_id' => $user->id,
            'image' => 'images/announces/' . $imageName,
            'status' => 'pending',
        ]);

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