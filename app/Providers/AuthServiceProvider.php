<?php

namespace App\Providers;

use App\Models\Project;
use App\Policies\ProjectPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Kebijakan pemetaan untuk aplikasi.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
    ];

    /**
     * Daftarkan layanan otorisasi.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('is-manager', function ($user) {
            return $user->role === 'manager';
        });

        Gate::define('is-sales', function ($user) {
            return $user->role === 'sales';
        });
    }
}
