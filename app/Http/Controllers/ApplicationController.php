<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
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
    public function show(Application $application)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Application $application)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Application $application)
    {
        //
    }

    //заявка, чтобы стать исполнителем
    public function applicationArtist(Request $request) {
        $valid = Validator::make($request->all(), [
            'category'=>['required'],
            'title'=>['required'],
            'text'=>['required'],
        ]);
        if ($valid->fails()) {
            return response()->json($valid->errors(), 400);
        }
        // dd($request->all());
        $application = new Application();
        $application->category_id = $request->category;
        $category = Category::query()->where('id', $request->category)->first();
        if ($category->title == 'стать исполнителем'){
            $user = User::query()->where('id', Auth::id())->first();
            $user->status = 'ожидающий';
            $user->nickname = $request->title;
            $user->update();
        }
        if($category->title == 'ограничение права'){
            $application->track_id = $request->id;
        }
        $application->user_id = Auth::id();
        $application->status = 'новый';
        $application->title = $request->title;
        $application->text = $request->text;
        
        $application->save();
        return response()->json('Заявка отправлена. Ожидайте подтверждение администратора');
    }
}
