<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Mission;
use App\Models\News;
use App\Models\Vision;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $visi = Vision::first();
        $misi = Mission::first();
        $misi_items = array_filter(explode("\n", trim($misi->mission)));
        $histories = History::all();
        $news = News::with('images')->latest()->take(3)->get();

        return view('welcome', compact('visi', 'misi_items', 'histories', 'news'));
    }
}
