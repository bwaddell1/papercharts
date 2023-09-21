<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class TeamUser extends Model
{
    use HasFactory;

    protected $table = 'team_user';
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        self::updated(function ($teamuser) {
            Log::info(1234);
            $teamuser->user->role_id = Role::where('name', $teamuser->role)->first()->id;
        });

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
