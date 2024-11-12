<?php

namespace App\Http\Controllers;

use App\Models\Generator\About;
use App\Models\Generator\Contact;
use App\Models\Generator\Gallery;
use App\Models\Generator\Slider;
use App\Models\Generator\Pengurus;
use App\Models\Generator\Perguruan;
use App\Models\Generator\Service;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = Slider::all();
        $services = Service::all();
        $perguruans = Perguruan::all();
        $about = About::first();
        $pengurus = Pengurus::all();
        $gallery = Gallery::all();
        $contact = Contact::first();

        return view('front.index', compact(
            'sliders',
            'services',
            'perguruans',
            'about',
            'pengurus',
            'gallery',
            'contact',
        ));
    }

    public function contact()
    {
        $contact = Contact::first();
        $services = Service::all();

        return view('front.contact', compact(
            'contact',
            'services',
        ));
    }

    public function about()
    {
        $about = About::first();
        $perguruans = Perguruan::all();
        $penguruses = Pengurus::all();
        $contact = Contact::first();
        $services = Service::all();

        return view('front.about', compact(
            'about',
            'perguruans',
            'penguruses',
            'contact',
            'services',
        ));
    }

    public function pengurus()
    {
        $penguruses = Pengurus::all();
        $contact = Contact::first();
        $services = Service::all();

        return view('front.pengurus', compact(
            'penguruses',
            'contact',
            'services',
        ));
    }

    public function gallery()
    {
        $gallery = Gallery::all();
        $contact = Contact::first();
        $services = Service::all();

        return view('front.gallery', compact(
            'gallery',
            'contact',
            'services',
        ));
    }

    public function services()
    {
        $services = Service::all();
        $contact = Contact::first();

        return view('front.services', compact(
            'services',
            'contact',
        ));
    }

    public function biodata(Request $request, $code)
    {

        $about = About::first();
        $perguruans = Perguruan::all();
        $penguruses = Pengurus::all();
        $contact = Contact::first();
        $services = Service::all();
        $user = User::withoutTrashed()->where('code', $code)->first(); // Contoh penggunaan ID
        // dd($user); // Untuk debug dan memastikan ID-nya tertangkap

        return view('front.biodata', compact(
            'about',
            'perguruans',
            'penguruses',
            'contact',
            'services',
            'user',
        ));
    }
}
