<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Officer;
use App\Models\OrganizationProfile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $profile = OrganizationProfile::first();
        $events = Event::where('status', 'upcoming')->orderBy('event_date', 'asc')->take(3)->get();
        return view('pages.home', compact('profile', 'events'));
    }

    public function profile()
    {
        $profile = OrganizationProfile::first();
        return view('pages.profile', compact('profile'));
    }

    public function officers()
    {
        $profile = OrganizationProfile::first();
        $rootOfficers = Officer::whereNull('parent_id')->orderBy('order_priority', 'asc')->get();
        return view('pages.officers', compact('profile', 'rootOfficers'));
    }

    // Fitur #6: Event dengan Search & Filter Kategori/Status
    public function events(Request $request)
    {
        $profile = OrganizationProfile::first();
        $query = Event::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $events = $query->orderBy('event_date', 'desc')->paginate(9)->withQueryString();

        return view('pages.events', compact('profile', 'events'));
    }

    // Fitur #2: Galeri
    public function galleries()
    {
        $profile = OrganizationProfile::first();
        $galleries = Gallery::with('event')->orderBy('created_at', 'desc')->paginate(9);
        return view('pages.galleries', compact('profile', 'galleries'));
    }

    // Fitur #3: Download Center Dokumen
    public function documents(Request $request)
    {
        $profile = OrganizationProfile::first();
        $query = Document::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $documents = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('pages.documents', compact('profile', 'documents'));
    }

    public function aspiration()
    {
        $profile = OrganizationProfile::first();
        return view('pages.aspiration', compact('profile'));
    }
}
