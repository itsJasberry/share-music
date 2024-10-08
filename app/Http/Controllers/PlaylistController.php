<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PlaylistRepository;
use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Playlist::class);
        return view(
            'playlists.index'
        );
    }

    public function async(Request $request, PlaylistRepository $repository)
    {
        return $repository->select(
            $request->search,
            $request->selected
        );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Playlist::class);

        return view(
            'playlists.form'
        );
    }
    public function songs($playlistId)
    {
        $playlist = Playlist::with(['songs'])->findOrFail($playlistId);
        $this->authorize('view', $playlist);

        return view('playlists.songs', compact('playlist'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        return view(
            'playlists.form',
            [
                'playlist' => $playlist
            ]
        );
    }
    public function __toString()
    {
        return $this->name;
    }

}
