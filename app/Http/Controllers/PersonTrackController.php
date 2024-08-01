<?php

namespace App\Http\Controllers;

use App\Models\personTrack;
use App\Models\User;
use Illuminate\Http\Request;

class PersonTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(personTrack $personTrack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(personTrack $personTrack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, personTrack $personTrack)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(personTrack $personTrack)
    {
        //
    }

    //получить авторов трека
    public function getNicknameForTrack($id) {
        // dd($id);
        $personsTrack = personTrack::query()->where('track_id', $id)->get();
        $nicknames = [];
        foreach($personsTrack as $person) {
            $nickname = User::query()->where('id', $person->user_id)->first();
            array_push($nicknames, $nickname->nickname);
        }
        
        return response()->json($nicknames);
    }
}
