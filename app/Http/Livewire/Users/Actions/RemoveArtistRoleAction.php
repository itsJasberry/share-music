<?php

namespace App\Http\Livewire\Users\Actions;

use LaravelViews\Views\View;
use LaravelViews\Actions\Action;
use Illuminate\Support\Facades\Auth;

class RemoveArtistRoleAction extends Action
{
    /**
     * Title
     * @var String
     * */
    public $title = '';

    public function __construct()
    {
        parent::__construct();
        $this->title = __('users.actions.remove_artist_role');
    }

    /**
     * This should be a valid Feather icon string
     * @var String
     */
    public $icon = 'pen-tool';

    /**
     * Execute the action when the user clicked on the button
     *
     * @param $model Model object of the list where the user has clicked
     * @param $view Current view where the action was executed from
     */
    public function handle($model, View $view)
    {
        $model->removeRole(config('auth.roles.artist'));
        $this->success(__('users.messages.successes.artist_role_removed'));
    }

    public function renderIf($model, View $view)
    {
        return Auth::user()->isAdmin()
            && $model->hasRole(config('auth.roles.artist'));
    }
}
