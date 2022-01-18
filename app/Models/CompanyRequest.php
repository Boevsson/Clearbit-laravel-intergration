<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class CompanyRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'company_domain',
        'data',
        'processed',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
