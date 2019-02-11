<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title='HOme page drugari';
        return view('pages.index')->with('title',$title);

    }
    public function about(){
        $title='This is About page';
        return view('pages.about')->with('title',$title);
    }
    public function services(){
        $data=array(
            'title' => 'Services',
            'services'=>['Web design','SEO','Marketing']
        );
        return view('pages.services')->with($data);

    }
}
