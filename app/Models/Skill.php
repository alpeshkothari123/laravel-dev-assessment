<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\jobPostings;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function jobPostings()
    {
        return $this->belongsToMany(JobPosting::class);
    }
}
