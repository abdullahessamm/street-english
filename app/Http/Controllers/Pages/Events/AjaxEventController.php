<?php

namespace App\Http\Controllers\Pages\Events;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Events\Event;

class AjaxEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $event = Event::query();

        return Datatables::of($event)
        ->editColumn('title', function ($event) {
            return '<a href="'.route('event.show', [$event->slug]).'">'.$event->title.'</a>';
        })
        ->editColumn('users', function ($event) {
            return $event->users->count();
        })
        
        ->rawColumns(['title'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $event_title = $request->input('event_title');
        $event_description = $request->input('event_description');
        $image = $request->file('image');
        $end_date = $request->input('end_date');
        $slug = $this->slugify($event_title);

        $event_image_name = md5(uniqid());

        $event = Event::firstOrCreate(['slug' => $slug], [
            'title' => $event_title,
            'description' => $event_description,
            'image' => $event_image_name.'.'.$image->getClientOriginalExtension(),
            'end_date' => $end_date,
            'slug' => $slug,
        ]);

        $event_image_path = $this->getUniversalPath('public/images/events/'.$event->id);

        $this->uploadFile($request, 'image', $event_image_path, $event_image_name);

        $this->successMsg("Event has been created");

        $this->redierctTo('event/show/'.$slug);
    }

    public function update(Request $request)
    {
        $event_id = $request->input('event_id');

        $event = Event::where('id', $event_id)->first();

        $event_title = $request->input('event_title');
        $event_description = $request->input('event_description');
        $end_date = $request->input('end_date');
        $slug = $this->slugify($event_title);

        if($request->hasFile('image'))
        {
            // get event image path
            $event_image_path = $this->getUniversalPath('public/images/events/'.$event_id);

            // get old image
            $old_image = $this->getUniversalPath('public/images/events/'.$event_id.'/'.$event->image);

            // remove old image
            $this->removeFile($old_image);

            $image = $request->file('image');
            
            // get new image name
            $event_image_name = md5(uniqid());

            // upload the new image
            $this->uploadFile($request, 'image', $event_image_path, $event_image_name);

            // change the image name for database
            $image = $event_image_name.'.'.$image->getClientOriginalExtension();
        }
        else
        {
            $image = $event->image;
        }

        Event::where('id', $event_id)->update([
            'title' => $event_title,
            'description' => $event_description,
            'image' => $image,
            'end_date' => $end_date,
            'slug' => $slug,
        ]);

        $this->successMsg("Event details has been updated");

        $this->redierctTo('event/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $event_id = $request->input('event_id');

        $event_image_path = $this->getUniversalPath('public/images/events/'.$event_id);

        if(Event::where('id', $event_id)->delete())
        {
            file_exists($event_image_path) ? $this->deleteDir($event_image_path) : true;

            $this->redierctTo('events');
        }
    }
}
