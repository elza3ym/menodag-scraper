<?php

namespace App\Providers;

use App\Jobs\ProcessData;
use App\Models\Data;
use App\Models\Session;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Queue;
use Illuminate\Queue\Events\JobFailed;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Queue::failing(function (JobFailed $event) {
            $session = Session::where('is_running', 1)->first();
            if (!$session) {
                $oldSession = Session::latest()->first();
                $session = new Session([
                    'pattern' => Setting::all()?->first()?->pattern ?: env('SCRAPPER_PATTERN'),
                    'is_running'    => 1,
                    'time'      => 0,
                ]);
                if ($oldSession?->pattern === $session->pattern) {
                    $session->current_number =  $oldSession->current_number;
                }
                $session->save();
            }
            if (!$session->current_number) {
                $session->current_number = Data::getNumber($session->pattern);
            } else {
                $session->current_number++;
            }
            $session->save();
            ProcessData::dispatch($session);
            echo "===============================================================".PHP_EOL;
            echo "Restarted".PHP_EOL;
            echo "===============================================================".PHP_EOL;
        });
    }
}
