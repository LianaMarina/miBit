<?php

use App\Http\Controllers\AlbomController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PersonTrackController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGenreController;
use App\Models\Playlist;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'welcome'])->name('welcome');

//показать страницу регистрации
Route::get('/guest/show_registration_page', [PageController::class, 'show_registration'])->name('show_registration');

//регистрация пользователя
Route::post('/guest/registration/', [UserController::class, 'registration'])->name('registration');

//добавить любимые жанры пользователя
Route::post('/user/send_fav_genres', [UserGenreController::class, 'sendFavGenres'])->name('sendFavGenres');

//показать страницу для входа
Route::get('/guest/show_auth_page', [PageController::class, 'show_auth'])->name('show_auth');

//авторизация
Route::post('/guest/auth/', [UserController::class, 'auth'])->name('auth');

//показать страницу с жанрами (админ)
Route::get('/admin/show_genres_page/', [PageController::class, 'show_admin_genres'])->name('show_admin_genres');

//показать страницу с завяками на исполнителей (админ)
Route::get('/admin/show_admin_users/', [PageController::class, 'show_admin_users'])->name('show_admin_users');

//показать страницу с треками (админ)
Route::get('/admin/show_admin_tracks/', [PageController::class, 'show_admin_tracks'])->name('show_admin_tracks');

//выход
Route::get('/user/exit', [UserController::class, 'exit'])->name('exit');

//добавить новый жанр
Route::post('/admin/add_genre/', [GenreController::class, 'add_genre'])->name('add_genre');

//изменить жанр
Route::post('/admin/update_genre/', [GenreController::class, 'update'])->name('update_genre');

//удалить жанр
Route::delete('/admin/delete_genre/{genre?}', [GenreController::class, 'destroy'])->name('delete_genre');

//показать профиль пользователя
Route::get('/user/show_profile/', [PageController::class, 'show_profile'])->name('show_profile');

//получить жанры пользователя
Route::get('/user/get_genres/', [UserGenreController::class, 'getGenres'])->name('getGenres');

//сохранить изменения в профиле пользователя
Route::post('/user/save_profile_changes/', [UserController::class, 'save_profile_changes'])->name('save_profile_changes');

//отправка заявки, чтобы стать исполнителем
Route::post('/user/send/applicationArtist', [ApplicationController::class, 'applicationArtist'])->name('applicationArtist');


//подтвердить заявку на исполнителя
Route::get('/admin/confirm_artist/{application?}', [UserController::class, 'confirm_artist'])->name('confirm_artist');

//отменить заявку на исполнителя
Route::get('/admin/cancel_artist/{application?}', [UserController::class, 'cancel_artist'])->name('cancel_artist');

//добавить трек
Route::post('/user/add_track/', [TrackController::class, 'add_track'])->name('add_track');

//добавить альбом
Route::post('/user/add_album/', [AlbomController::class, 'add_album'])->name('add_album');

//показать страницу проигрывания трека
Route::get('/show_play_page/{track?}', [PageController::class, 'show_page_play'])->name('show_page_play');

//получить авторов трека
Route::get('/get/track_nicknames/{id?}', [PersonTrackController::class, 'getNicknameForTrack'])->name('getNicknameForTrack');

//получить всех исполнителей
Route::get('user/get_all_artists/', [UserController::class, 'get_all_artists'])->name('get_all_artists');

//получить все треки пользователя
Route::get('user/get_all_user_tracks/', [TrackController::class, 'get_all_user_tracks'])->name('get_all_user_tracks');

//получить 4 доступных новых треков
Route::get('/get_all_new_tracks/', [TrackController::class, 'get_new_tracks'])->name('get_new_tracks');

//получить трек
Route::get('/get_detail_track/{id?}', [TrackController::class, 'get_detail_track'])->name('get_detail_track');

//добавить +1 к прослушиванию трека
Route::get('/add_count_listen_track/{id?}', [TrackController::class, 'addCountListen'])->name('addCountListen');

//создать плейлист и добавить туда трек
Route::post('/user/create_playlist_add_track/{id?}', [PlaylistController::class, 'createPlaylist'])->name('createPlaylist');

//получить все плейлисты пользователя
Route::get('/user/get_all_playlists/', [PlaylistController::class, 'get_all_userPlaylists'])->name('get_all_userPlaylists');

//добавить трек в playlist со страницы проигрывания
Route::get('/user/add_track_playlist/{playlist_id?}/{track_id?}', [PlaylistController::class, 'add_track_playlist'])->name('add_track_playlist');

//добавить трек в playlist со страницы с несколькими треками
Route::post('/user/add_track_my_playlist/', [PlaylistController::class, 'add_track_my_playlist'])->name('add_track_my_playlist');

//показать страницу поиска 
Route::get('/show/search_page/', [PageController::class, 'show_search_page'])->name('show_search_page');

//получить все треки, которые в доступе
Route::get('/user/get_tracks/', [TrackController::class, 'get_all_tracks'])->name('get_all_tracks');

//получить все альбомы
Route::get('/get/all_albums/', [AlbomController::class, 'get_all_albums'])->name('get_all_albums');

//получить все плейлисты
Route::get('/get/all_playlists/', [PlaylistController::class, 'get_all_playlists'])->name('get_all_playlists');

//показать страницу с работами исполнителя
Route::get('/show/artist_works/', [PageController::class, 'show_works_page'])->name('show_works_page');

//получить все мои треки
Route::get('/user/get_all_my_tracks/', [TrackController::class, 'get_my_tracks'])->name('get_my_tracks');

//получить все мои альбомы
Route::get('/user/get_all_my_albums/', [AlbomController::class, 'get_my_albums'])->name('get_my_albums');