<?php

namespace App\Providers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\ValidationException;
use Spark\Plan;
use Spark\Spark;
use Laravel\Cashier\Cashier;

class SparkServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        Spark::ignoreMigrations();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Cashier::useCustomerModel(Team::class);

        Spark::billable(Team::class)->resolve(function (Request $request) {
            return $request->user()->currentTeam;
        });

        Spark::billable(Team::class)->chargePerSeat('provider', function ($billable) {
            return count($billable->provider());
        });

        Spark::billable(Team::class)->authorize(function (Team $billable, Request $request) {
            return $request->user() &&
                   $request->user()->id == $billable->user_id;
        });

        Spark::billable(Team::class)->checkPlanEligibility(function (Team $billable, Plan $plan) {
            // if ($billable->projects > 5 && $plan->name == 'Basic') {
            //     throw ValidationException::withMessages([
            //         'plan' => 'You have too many projects for the selected plan.'
            //     ]);
            // }
        });
    }
}
