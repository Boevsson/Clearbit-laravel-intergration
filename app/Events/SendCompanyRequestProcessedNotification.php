<?php

namespace App\Events;

class SendCompanyRequestProcessedNotification
{
    /**
     * Handle the event.
     *
     * @param CompanyRequestProcessed $event
     * @return void
     */
    public function handle(CompanyRequestProcessed $event)
    {
        $event->companyRequest->user->sendCompanyRequestProcessedNotification($event->companyRequest);
    }
}
