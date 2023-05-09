<?php

namespace App\Http\Controllers\Pages\AboutUs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;

class AboutUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.about-us.index');
    }

    public function updateAboutUsContent(Request $request)
    {
        $content = $request->input('content');

        if(AboutPage::count() == 0)
        {
            $AboutPage = new AboutPage();
            $AboutPage->content = $content;
            
            if($AboutPage->save())
            {
                echo $this->successMsg("About us page content has been updated");
            }
        }
        else
        {
            AboutPage::first()->update([
                'content' => $content
            ]);

            echo $this->successMsg("About us page content has been updated");
        }
    }
}
