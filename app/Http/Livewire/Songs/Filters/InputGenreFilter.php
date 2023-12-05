<?php

namespace App\Http\Livewire\Songs\Filters;

use App\Http\Livewire\Playlists\Filters\Value;
use Illuminate\Database\Eloquent\Builder;
use LaravelViews\Filters\Filter;

/**
 * Filtr użytkownika
 */
class InputGenreFilter extends Filter
{
    public $type = 'input';
    public $view = 'input-filter';
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('songs.filters.genres');
    }

    /**
     * Zastosowanie filtra
     *
     * @param Builder $query Current query
     * @param $value Value selected by the user
     * @return Builder Query modified
     */
    public function apply(Builder $query, $value, $request): Builder
    {
        return $query->whereHas('genres', function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%');
        });
    }
}
