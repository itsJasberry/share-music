<?php

namespace App\Http\Controllers;

use App\Http\Repositories\AlbumRepository;
use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Album::class);
        return view(
            'albums.index'
        );
    }

    public function async(Request $request, AlbumRepository $repository)
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
        $this->authorize('create', Album::class);

        return view(
            'albums.form'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        $this->authorize('update', $album);
        return view(
            'albums.form',
            [
                'album' => $album
            ]
        );
    }
    public function showSongs($albumId)
    {
        $album = Album::with(['songs'])->findOrFail($albumId);
        // 'songs' to nazwa relacji zdefiniowana w modelu Album

        return view('albums.songs', compact('album'));
    }
    public function __toString()
    {
        return $this->name;
    }
}
