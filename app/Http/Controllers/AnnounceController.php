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
        $size = $request->query('size');
        $query = Announce::where('status', 'accepted')
            ->with('user');

        if ($size || $size == 0) {
            $query->limit($size);
        }

        $announces = $query->get();
        return response()->json($announces);
    }

    public function getUserAnnounces(Request $request)
    {
        $user = $request->user();
        $announces = Announce::where('user_id', $user->id)
            ->with('user')
            ->get();
        return response()->json($announces);
    }

    public function acceptAnnounce(Request $request, $id)
    {
        $announce = Announce::find($id);
        $announce->status = 'accepted';
        $announce->request_type = null;
        $announce->save();
        return response()->json($announce);
    }

    public function getOtherUserAcceptedAnnounces(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'announce_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $announce = Announce::find($request->announce_id);
        $id = $announce->user_id;
        $announces = Announce::where('user_id', $id)
            ->where('status', 'accepted')
            ->where('id', '<>', $request->announce_id)
            ->with('user')
            ->get();
        return response()->json($announces);
    }

    public function declineAnnounce(Request $request, $id)
    {
        $announce = Announce::find($id);
        $announce->status = 'rejected';
        $announce->request_type = null;
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category' => 'required|string|max:255',
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
            'category' => $request->category,
            'status' => 'pending',
            'request_type' => 'creation'
        ]);

        return response()->json($announce);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $announce = Announce::find($id);

        $announce->title = $request->title;
        $announce->description = $request->description;
        $announce->country = $request->country;
        $announce->city = $request->city;
        $announce->postal_code = $request->postal_code;
        $announce->request_type = 'modification';
        $announce->status = 'pending';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $announce->id . '.' . $image->extension();
            $image->move(public_path('images/announces'), $imageName);
            $announce->image = 'images/announces/' . $imageName;
        }

        $announce->save();

        return response()->json($announce);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $announce = Announce::find($id);
        $announce->delete();
        return response()->json('Announce deleted successfully');
    }
}