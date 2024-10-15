<?php

namespace App\Http\Controllers;

use App\Models\Announce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnnounceController extends Controller
{
    /**
     * Get all announces that are not rejected.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // Get all announces that are not rejected. Order them by status (pending first, then accepted)
        // and then by creation date (newest first).
        $announces = Announce::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        // Return the announces
        return response()->json($announces);
    }

    /**
     * Get all accepted announces.
     *
     * @queryParam size int The number of records to return. If not given, returns all.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Get all announces from the current user.
     *
     * @authenticated
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserAnnounces(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();
        // Get all announces from the user
        $announces = Announce::where('user_id', $user->id)
            ->with('user')
            ->get();
        // Return the announces
        return response()->json($announces);
    }

    /**
     * Accept an announce.
     *
     * @authenticated
     * @urlParam id int required The ID of the announce
     *
     * @response 200 {
     *   "id": 1,
     *   "title": "Announce title",
     *   "description": "Announce description",
     *   "country": "Announce country",
     *   "city": "Announce city",
     *   "postal_code": "Announce postal code",
     *   "image": "Announce image",
     *   "user_id": 1,
     *   "created_at": "2020-01-01 00:00:00",
     *   "updated_at": "2020-01-01 00:00:00",
     *   "status": "accepted"
     * }
     *
     * @response 404 {
     *   "message": "Announce not found"
     * }
     *
     * @response 401 {
     *   "message": "Unauthorized"
     * }
     */
    public function acceptAnnounce(Request $request, $id)
    {
        $announce = Announce::find($id);
        $announce->status = 'accepted';
        $announce->request_type = null;
        $announce->save();
        return response()->json($announce);
    }

    /**
     * Get all accepted announces for a given user except the one given.
     *
     * @authenticated
     * @queryParam announce_id int required The ID of the announce
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "id": 1,
     *       "title": "Announce title",
     *       "description": "Announce description",
     *       "country": "Announce country",
     *       "city": "Announce city",
     *       "postal_code": "Announce postal code",
     *       "image": "Announce image",
     *       "user_id": 1,
     *       "created_at": "2020-01-01 00:00:00",
     *       "updated_at": "2020-01-01 00:00:00",
     *       "status": "accepted",
     *       "user": {
     *         "id": 1,
     *         "name": "User name",
     *         "email": "user@example.com",
     *       }
     *     }
     *   ]
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "announce_id": [
     *       "The announce id field is required."
     *     ]
     *   }
     * }
     *
     * @response 401 {
     *   "message": "Unauthorized"
     * }
     */
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

    /**
     * Decline an announce.
     *
     * @authenticated
     * @urlParam id int required The ID of the announce
     *
     * @response 200 {
     *   "id": 1,
     *   "title": "Announce title",
     *   "description": "Announce description",
     *   "country": "Announce country",
     *   "city": "Announce city",
     *   "postal_code": "Announce postal code",
     *   "image": "Announce image",
     *   "user_id": 1,
     *   "created_at": "2020-01-01 00:00:00",
     *   "updated_at": "2020-01-01 00:00:00",
     *   "status": "rejected"
     * }
     *
     * @response 404 {
     *   "message": "Announce not found"
     * }
     *
     * @response 401 {
     *   "message": "Unauthorized"
     * }
     */
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
     *
     * @authenticated
     *
     * @bodyParam title string required The title of the announce
     * @bodyParam description string required The description of the announce
     * @bodyParam country string required The country of the announce
     * @bodyParam city string required The city of the announce
     * @bodyParam postal_code string required The postal code of the announce
     * @bodyParam image image required The image of the announce
     * @bodyParam category string required The category of the announce
     *
     * @response 200 {
     *   "id": 1,
     *   "title": "Announce title",
     *   "description": "Announce description",
     *   "country": "Announce country",
     *   "city": "Announce city",
     *   "postal_code": "Announce postal code",
     *   "image": "Announce image",
     *   "user_id": 1,
     *   "created_at": "2020-01-01 00:00:00",
     *   "updated_at": "2020-01-01 00:00:00",
     *   "status": "pending",
     *   "request_type": "creation"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *   "errors": {
     *     "title": [
     *       "The title field is required."
     *     ],
     *     "description": [
     *       "The description field is required."
     *     ],
     *     "country": [
     *       "The country field is required."
     *     ],
     *     "city": [
     *       "The city field is required."
     *     ],
     *     "postal_code": [
     *       "The postal code field is required."
     *     ],
     *     "image": [
     *       "The image field is required."
     *     ],
     *     "category": [
     *       "The category field is required."
     *     ]
     *   }
     * }
     *
     * @response 401 {
     *   "message": "Unauthorized"
     * }
     */
    public function store(Request $request)
    {
        // Validate the request
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
            // Return the validation errors
            return response()->json($validator->errors(), 422);
        }

        // Get the authenticated user
        $user = $request->user();

        // Store the announce image
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/announces'), $imageName);

        // Create a new announce
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

        // Return the announce
        return response()->json($announce);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Get the announce to be updated
        $announce = Announce::find($id);

        // Fill the announce with the new data
        $announce->fill($request->only([
            'title',
            'description',
            'country',
            'city',
            'postal_code',
        ]));

        // If the request contains an image, store it and update the announce
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/announces'), $imageName);
            // Store the image
            $announce->image = 'images/announces/' . $imageName;
        }

        // Set the request type to modification and the status to pending
        $announce->request_type = 'modification';
        $announce->status = 'pending';
        // Save the announce
        $announce->save();

        // Return the updated announce
        return response()->json($announce);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Get the announce to be deleted
        $announce = Announce::find($id);

        // Delete the announce
        $announce->delete();

        // Return a success message
        return response()->json('Announce deleted successfully');
    }
}