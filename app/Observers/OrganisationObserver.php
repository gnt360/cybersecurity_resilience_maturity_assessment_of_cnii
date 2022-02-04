<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Organisation;

class OrganisationObserver
{
    /**
     * Handle the Organisation "created" event.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return void
     */
    public function creating(Organisation $organisation)
    {
        $organisation->code = Str::random(5);
    }

    /**
     * Handle the Organisation "updated" event.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return void
     */
    public function updated(Organisation $organisation)
    {
        //
    }

    /**
     * Handle the Organisation "deleted" event.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return void
     */
    public function deleted(Organisation $organisation)
    {
        //
    }

    /**
     * Handle the Organisation "restored" event.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return void
     */
    public function restored(Organisation $organisation)
    {
        //
    }

    /**
     * Handle the Organisation "force deleted" event.
     *
     * @param  \App\Models\Organisation  $organisation
     * @return void
     */
    public function forceDeleted(Organisation $organisation)
    {
        //
    }
}
