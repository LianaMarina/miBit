<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class GenreController extends Controller
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
    public function create(Request $request)
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
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        //
        $genre = Genre::query()->where('id', $request->id)->first();
//  dd($genre);
        $valid = Validator::make($request->all(), [
            'title'=>['required', Rule::unique('genres', 'title')->ignore($request->id),], //ПРОВЕРИТЬ
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $genre->title = $request->title;
        if ($request->file('img')) {
            $file = $request->file('img')->store('/public/img');
            $genre->img = '/storage/'.$file;
        }
        $genre->update();

        return response()->json('Жанр добавлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        //
        $genre->delete();
        return redirect()->back();
    }

    //добавить жанр
    public function add_genre(Request $request) {
        $valid = Validator::make($request->all(), [
            'title'=>['required', 'unique:genres'],
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        $genre = new Genre();
        $genre->title = $request->title;
        if ($request->file('img')) {
            $file = $request->file('img')->store('/public/img');
            $genre->img = '/storage/'.$file;
        }
        $genre->save();

        return response()->json('Жанр добавлен');
    }
}
