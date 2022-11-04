<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubmissionFurlough extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_APPROVE = 'approve';
    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'start_date', 'last_date', 'reason', 'submission_date',
        'status', 'approve_date', 'user_id', 'furlough_type',
        'employee_occupation'
    ];

    // Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Acessor
    public function getFormatStartDateAttribute()
    {
        return Carbon::parse($this->start_date)->format('d F Y');
    }

    public function getFormatLastDateAttribute()
    {
        return Carbon::parse($this->last_date)->format('d F Y');
    }

    public function getFormatSubmissionDateAttribute()
    {
        return Carbon::parse($this->submission_date)->format('d F Y');
    }

    public function getFormatApproveDateAttribute()
    {
        return Carbon::parse($this->approve_date)->format('d F Y');
    }
}
