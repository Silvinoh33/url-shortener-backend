<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd( Auth::user()->id);
        $links = Link::where('user_id', Auth::user()->id)->paginate(5);

        return response()->json($links);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $link = new Link([
            "full_link" => $request->full_link,
            "short_link" => $request->short_link,
            "user_id" => Auth::user()->id,
            "views" => 0 // pour le moment on le met à 0
        ]);
        $link->save();

        return response()->json($link, 201); // status créé 
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        return response()->json($link);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $link->full_link = $request->full_link;
        $link->short_link = $request->short_link;

        $link->save();
        return response()->json($link);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return response()->noContent(); // status vide
    }
}
