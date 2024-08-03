<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Playlist;
use App\Models\UserGenre;
use App\Models\UserPlaylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserGenreController extends Controller
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
    public function show(UserGenre $userGenre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserGenre $userGenre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserGenre $userGenre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserGenre $userGenre)
    {
        //
    }

    //добавить любимые жанры пользователя
    public function sendFavGenres(Request $request)
    {
        // dd($request->all());
        foreach ($request->selectedGenres as $genre) {
            $userGenre = new UserGenre();
            $userGenre->user_id = Auth::id();
            $userGenre->genre_id = $genre;
            $userGenre->save();
        }
        return response()->json('Любимые жанры сохранены');
    }

    //получить любимые жанры пользователя
    public function getGenres()
    {
        $genres = UserGenre::query()->where('user_id', Auth::id())->get();

        $genres_id = [];
        foreach ($genres as $genre) {
            array_push($genres_id, $genre->genre_id);
        }
        // dd($genres_id);
        return response()->json($genres_id);
    }
}
