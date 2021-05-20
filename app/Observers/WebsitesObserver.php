<?php

namespace App\Observers;

use App\Models\Websites;

class WebsitesObserver
{
    /**
     * Handle the websites "created" event.
     *
     * @param Websites $websites
     * @return void
     */
    public function created(Websites $websites)
    {
        //
    }

    /**
     * Handle the websites "updated" event.
     *
     * @param Websites $websites
     * @return void
     */
    public function updated(Websites $websites)
    {
        //
        dd('updated================');
    }

    /**
     * Handle the websites "deleted" event.
     *
     * @param Websites $websites
     * @return void
     */
    public function deleted(Websites $websites)
    {
        //
    }

    /**
     * Handle the websites "restored" event.
     *
     * @param Websites $websites
     * @return void
     */
    public function restored(Websites $websites)
    {
        //
    }

    /**
     * Handle the websites "force deleted" event.
     *
     * @param Websites $websites
     * @return void
     */
    public function forceDeleted(Websites $websites)
    {
        //
    }
}
