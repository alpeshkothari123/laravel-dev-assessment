<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\skills;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','company_logo','company_name','experience','salary','location',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }
}
