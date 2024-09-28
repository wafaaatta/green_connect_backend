<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size');
        $query = Event::with('manager')->orderBy('created_at', 'desc');
        if ($size || $size == 0) {
            $query->limit($size);
        }
        $events = $query->get();
        return response()->json($events);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string',
            'organized_by' => 'required|string',
            'manager_id' => 'required|integer|exists:managers,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images/events'), $imageName);

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'organized_by' => $request->organized_by,
            'manager_id' => $request->manager_id,
            'image' => 'images/events/' . $imageName
        ]);

        return response()->json($event);
    }

    public function show($id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    public function update(Request $request, $id)
{
    $event = Event::find($id);

    if (!$event) {
        return response()->json(['error' => 'Event not found'], 404);
    }

    if ($request->hasFile('image')) {
        try {
            $image = $request->file('image');
            $imageName = $event->id . '.' . $image->extension();

            // Move the file to the specified path
            $image->move(public_path('images/events'), $imageName);

            // Update the event with the new image
            $event->image = 'images/events/' . $imageName;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upload image: ' . $e->getMessage()], 500);
        }
    }

    // Update other fields
    $event->update($request->only(['title', 'description', 'event_date', 'location', 'organized_by', 'manager_id']));

    return response()->json($event);
}


    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json('Event deleted successfully');
    }
}