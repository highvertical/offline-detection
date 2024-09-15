# Laravel Offline Detection Package

This package provides real-time internet connection monitoring for Laravel applications, with features like offline detection, reconnection handling, and syncing offline data when the internet is restored.

## Features

- **Real-time Connection Monitoring**: Automatically detects when a user goes offline and comes back online.
- **Reconnection Handling**: Shows user-friendly banners notifying users about the connection status.
- **Offline Data Synchronization**: Automatically syncs data (e.g., form submissions or other actions) stored while the user was offline, once the connection is restored.
- **Customizable UI**: Display customizable notifications for connection status changes (online/offline).
- **Configurable Timeout**: Set a custom timeout to check connection status using the config file.

## Installation

1. Install the package via Composer (if you’re planning to publish this package, otherwise just copy the files into your Laravel project).

    ```bash
    composer require your-namespace/offline-detection
    ```

2. Publish the package assets (views, config, and JS files):

    ```bash
    php artisan vendor:publish --provider="OfflineDetection\Providers\OfflineDetectionServiceProvider" --tag="config"
    php artisan vendor:publish --provider="OfflineDetection\Providers\OfflineDetectionServiceProvider" --tag="views"
    php artisan vendor:publish --provider="OfflineDetection\Providers\OfflineDetectionServiceProvider" --tag="assets"
    ```

3. Optionally, you can configure the package in `.env`:

    ```env
    OFFLINE_DETECTION_ENABLED=true
    OFFLINE_DETECTION_TIMEOUT=5000
    ```

## Usage

1. Add the following route to your `routes/web.php` file to display the offline page:

    ```php
    Route::get('/offline', function () {
        return view('offlinedetection::offline');
    })->name('offline');
    ```

2. Add the following script to your main layout file (usually `resources/views/layouts/app.blade.php` or similar) to enable the offline detection feature:

    ```html
    <script src="{{ asset('vendor/offlinedetection/offline-detection.js') }}"></script>
    ```

3. When users go offline, they will be redirected to `/offline`, and when they come back online, the page will automatically reload or display a banner indicating the restored connection.

## Configuration

The configuration file `config/offline-detection.php` allows you to set options like:

- `enabled`: Enable or disable offline detection globally.
- `timeout`: Set the time interval (in milliseconds) for checking the connection status.

## Customization

- **Views**: To customize the offline view, modify the published view in `resources/views/vendor/offlinedetection/offline.blade.php`.
- **JS Assets**: The JavaScript file responsible for the offline detection is located at `public/vendor/offlinedetection/offline-detection.js`. You can modify it according to your needs.

## Offline Data Synchronization

To store and sync user actions when offline, use `localStorage`. For example, if you want to store form data when the user is offline:

```js
function saveOfflineData(actionData) {
    let offlineData = JSON.parse(localStorage.getItem('offlineData')) || [];
    offlineData.push(actionData);
    localStorage.setItem('offlineData', JSON.stringify(offlineData));
}
