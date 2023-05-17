<?php

namespace App\Observers;

use App\Admin;

class AdminObserver
{
    /**
     * Handle the Admin "updated" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function updated(Admin $admin)
    {
        $abilitiesUpdated = ! ($admin->getOriginal('abilities') === $admin->abilities);
        
        if ($abilitiesUpdated)
            $admin->tokens()->delete();
    }

    /**
     * Handle the Admin "deleted" event.
     *
     * @param  \App\Models\Admin  $admin
     * @return void
     */
    public function deleted(Admin $admin)
    {
        //
    }
}
