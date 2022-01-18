<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessCompanyRequest;
use App\Models\CompanyRequest;
use Illuminate\Http\Request;

class CompanyRequestController extends Controller
{
    public function getAll(Request $request)
    {
        $companyRequests = CompanyRequest::get();

        return response()->json($companyRequests);
    }

    public function getCompanyInfo(Request $request, $companyDomain)
    {
        $companyRequest = CompanyRequest::where('company_domain', $companyDomain)->firstOrFail();

        return response()->json(json_decode($companyRequest->data));
    }

    public function getCompanyRequestInfo(Request $request, $companyDomain)
    {
        $companyRequest = CompanyRequest::where('company_domain', $companyDomain)->first();

        return response()->json($companyRequest);
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'company_name'   => ['required'],
            'company_domain' => ['required', 'unique:company_requests'],
        ]);

        $companyRequest = CompanyRequest::create([
            'company_name'   => $fields['company_name'],
            'company_domain' => $fields['company_domain'],
            'user_id'        => auth()->user()->id
        ]);

        ProcessCompanyRequest::dispatch($companyRequest);

        return response()->json('The request is stored and will be processed as soon as possible', 200);
    }
}