<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteTemplate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

}
