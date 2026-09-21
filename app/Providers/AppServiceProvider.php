<?php

namespace App\Providers;

use App\Models\Employee;
use App\Observers\EmployeeObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Employee::observe(EmployeeObserver::class);

        Blade::directive('jalali', function ($expression) {
            return "<?php echo e(\\App\\Helpers\\JalaliHelper::format($expression)); ?>";
        });
    }
}