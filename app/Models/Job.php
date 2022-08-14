<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'date_applied',
        'job_title',
        'post_url',
        'salary',
        'status',
        'description'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
