<?php

namespace OfflineDetection\Providers;

use Illuminate\Support\ServiceProvider;

class OfflineDetectionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'offlinedetection');

        // Publish configuration
        $this->publishes([
            __DIR__ . '/../../config/offline-detection.php' => config_path('offline-detection.php'),
        ], 'config');

        // Publish views
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/offlinedetection'),
        ], 'views');

        // Publish JS assets
        $this->publishes([
            __DIR__ . '/../../public/js' => public_path('vendor/offlinedetection'),
        ], 'assets');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/offline-detection.php', 'offline-detection'
        );
    }
}