<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('manager')->get();
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
            'image' => $imageName
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
        $event->update($request->all());

        return response()->json($event);
    }

    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json('Event deleted successfully');
    }
}
