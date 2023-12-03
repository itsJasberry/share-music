<?php

namespace App\Policies;

use App\Models\RecordLabel;
use App\Models\Song;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SongPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('songs.index');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('songs.manage');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Song $song)
    {
        return $song->deleted_at === null
            && $user->can('songs.manage');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Song $song)
    {
        return $song->deleted_at === null
            && $user->can('$song.manage');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Song $song)
    {
        return $song->deleted_at !== null
            && $user->can('songs.manage');
    }
}
