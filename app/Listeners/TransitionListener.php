<?php

namespace App\Listeners;

class TransitionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(\Sebdesign\SM\Event\TransitionEvent $event)
    {
        //
        if (rand(1, 2) === 2) {
            $event->setRejected();
        }
    }
}
