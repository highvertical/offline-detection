// src/Providers/OfflineDetectionServiceProvider.php
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

// routes/web.php 
<?php

use Illuminate\Support\Facades\Route;

Route::get('/offline', function () {
    return view('offlinedetection::offline');
})->name('offline');

// resources/views/offline.blade.php --
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Internet Connection</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .offline-message {
            text-align: center;
        }
        h1 {
            font-size: 3rem;
            color: #333;
        }
        p {
            font-size: 1.2rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="offline-message">
        <h1>You are offline</h1>
        <p>Please check your internet connection.</p>
    </div>
</body>
</html>


// public/js/offline-detection.js
document.addEventListener('DOMContentLoaded', function () {
    function checkOnlineStatus() {
        if (navigator.onLine) {
            window.location.reload(); // Reload page when internet is restored
        } else {
            window.location.href = '/offline';
        }
    }

    // Listen for changes in connection status
    window.addEventListener('online', checkOnlineStatus);
    window.addEventListener('offline', checkOnlineStatus);

    // Check the status on page load
    checkOnlineStatus();
});


// Config/offline-detection.php
<?php 

return [
    'enabled' => env('OFFLINE_DETECTION_ENABLED', true), // Toggle based on environment
    'timeout' => 5000, // Time in milliseconds (5 seconds)
];