<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;
use Spark\Billable;

class Team extends JetstreamTeam
{
    use HasFactory;
    use Billable;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'personal_team' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array<string, class-string>
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    
    public function isOnTrial()
    {
        return !$this->subscribed('default') && $this->onTrial();
    }

    public function subscribedPlan($plan)
    {
        if($this->subscribed('default') && $this->subscription('default')->stripe_price == $plan){
            return true;
        }
        return false;
    }

    public function providers()
    {
        return $this->users->where('role_id', Role::where('name', 'provider')->first()->id);
    }

    public function provider_count()
    {
        return max($this->users->where('role_id', Role::where('name', 'provider')->first()->id)->count(), 1);
    }

}
