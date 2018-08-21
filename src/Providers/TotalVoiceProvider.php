<?php

namespace TotalVoice\Providers;

use Illuminate\Support\ServiceProvider;

class TotalVoiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__ . '/../config/totalvoice.php' => config_path('totalvoice.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        
    }
}
