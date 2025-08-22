<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('event.index', [
            'events' => Event::all(),
            'participations' => Participant::all()
        ]);
    }

    public function create()
    {
        return view('event.create');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.update', [
            'event' => $event
        ]);
    }

    public function updateEvent(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $validated = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required'
        ]);
        $event->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'location' => $validated['location']    

        ]);
        $event->save();
        return redirect()->route('events.index')->with('success', 'Event modifié');
    }

    public function store()
    {
        $validated = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'location' => 'required'
        ]);
        $validated['creator_id'] = auth()->user()->id;
        $user = Event::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'location' => $validated['location'],
            'creator_id' => $validated['creator_id']
        ]);
        $user->save();
        return redirect()->route('events.index')->with('success', 'Event créer');
    }

    public function show()
    {
        return view('event.show');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event) {
            $title = $event->title;
            $event->delete();
            return redirect()->route('events.index')->with('success', 'L\'utilisateur ' . $title . ' a bien été supprimé.');
        }
        return redirect()->route('events.index')->with('error', 'L\'event concerné n\'est pas présent dans la liste des events enregistrés.');
    }
}
