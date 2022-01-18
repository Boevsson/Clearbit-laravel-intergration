<?php

namespace App\Events;

use App\Models\CompanyRequest;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CompanyRequestProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $companyRequest;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CompanyRequest $companyRequest)
    {
        $this->companyRequest = $companyRequest;
    }
}
