<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'date_applied',
        'job_title',
        'post_url',
        'salary',
        'status'
    ];

    // A job application belongs to a user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
