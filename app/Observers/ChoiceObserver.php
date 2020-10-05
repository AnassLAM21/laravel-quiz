<?php

namespace App\Observers;

use App\Choice;

class ChoiceObserver
{
    /**
     * Handle the choice "created" event.
     *
     * @param  \App\Choice  $choice
     * @return void
     */
    public function created(Choice $choice)
    {
        $choice->question->increment('choices_count'); 
    }

    /**
     * Handle the choice "updated" event.
     *
     * @param  \App\Choice  $choice
     * @return void
     */
    public function updated(Choice $choice)
    {
        //
    }

    /**
     * Handle the choice "deleted" event.
     *
     * @param  \App\Choice  $choice
     * @return void
     */
    public function deleted(Choice $choice)
    {
        //
    }

    /**
     * Handle the choice "restored" event.
     *
     * @param  \App\Choice  $choice
     * @return void
     */
    public function restored(Choice $choice)
    {
        //
    }

    /**
     * Handle the choice "force deleted" event.
     *
     * @param  \App\Choice  $choice
     * @return void
     */
    public function forceDeleted(Choice $choice)
    {
        //
    }
}
