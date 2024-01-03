<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('viewTelescope', function (User $user) {
            return in_array($user->email, [
                'jcarneiro@professor.educacao.sp.gov.br',
            ]);
        });

        Gate::before(function (User $user) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        // Verifica se existe a tabela permissions
        $permissions = Schema::hasTable('permissions');

        if ($permissions) {
            $permissions = Permission::all();
        } else {
            $permissions = [];
        }

        foreach ($permissions as $permission) {
            Gate::define($permission->slug, function (User $user) use ($permission) {
                return $user->hasPermissionRole($permission);
            });
        }

    }
}
