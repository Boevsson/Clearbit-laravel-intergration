<?php

namespace App\Jobs;

use App\Models\Clearbit;
use App\Models\CompanyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use App\Events\CompanyRequestProcessed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessCompanyRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $companyRequest;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(CompanyRequest $companyRequest)
    {
        $this->companyRequest = $companyRequest;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $clearbit = new Clearbit(env('CLEARBIT_API_KEY'));
        $body = $clearbit->getCompany($this->companyRequest->company_domain);

        $this->companyRequest->data = $body;
        $this->companyRequest->processed = true;
        $this->companyRequest->save();

        event(new CompanyRequestProcessed($this->companyRequest));
    }
}
