<?php

namespace App\Http\Controllers\Pages\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events\Event;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.events.index');
    }

    public function create()
    {
        return view('pages.events.create');
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->first();

        return view('pages.events.show')->with('event', $event);
    }
}
