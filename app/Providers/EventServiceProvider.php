<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Project;
use App\Models\ProjectServer;
use App\Models\ServerFirewallRules;
use App\Models\User;
use App\Observers\CompanyObserver;
use App\Observers\ProjectObserver;
use App\Observers\ProjectServerObserver;
use App\Observers\ServerFirewallRulesObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \Illuminate\Auth\Events\Verified::class => [
            \App\Listeners\EmailVerified::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
        User::observe(UserObserver::class);
        Project::observe(ProjectObserver::class);
        ProjectServer::observe(ProjectServerObserver::class);
        Company::observe(CompanyObserver::class);
//        ServerFirewallRules::observe(ServerFirewallRulesObserver::class);
    }
}
