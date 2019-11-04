<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Passport::tokensCan([
            'write-user' => 'Write user',
            'read-user' => 'Read user',
            'delete-user' => 'Delete user',

            'write-outlet' => 'Write outlet',
            'delete-outlet' => 'Delete outlet',

            'write-supplier' => 'Write supplier',
            'read-supplier' => 'Read supplier',
            'delete-supplier' => 'Delete supplier',

            'read-doctor' => 'Read doctor',
            'write-doctor' => 'Write doctor',
            'delete-doctor' => 'Delete doctor',

            'write-medicine' => 'Write medicine',
            'delete-medicine' => 'Delete medicine',

            'read-procurement' => 'Read procurement',
            'write-procurement' => 'Write procurement',
            'delete-procurement' => 'Delete procurement',
            'update-procurement' => 'Update procurement',
            'retrieve-procurement' => 'Retrieve procurement',

            'read-transaction' => 'Read transaction',
            'write-transaction' => 'Write transaction',
        ]);
    }
}
