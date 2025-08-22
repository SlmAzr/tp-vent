<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipationController extends Controller
{
    public function index() {
        return view('participation.index');
    }

    public function create() {
        return view('participation.create');
    }

    public function store($id) {
    Participant::create([
        'event_id' => $id,
        'user_id' => auth()->id(),
    ]);
        return redirect()->route('dashboard')->with('success','Participation crée');
    }

    public function show() {
        return view('dashboard');
    }
}
