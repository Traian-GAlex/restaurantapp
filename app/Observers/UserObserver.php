<?php

namespace App\Observers;

use App\Data\Models\User;
use App\Data\Models\Person as Prs;

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\Data\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $person = new Prs();
        $person->user_id = $user->id;
        $person->image = "noimage.png";
        $person->save();
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Data\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Data\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Data\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Data\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
