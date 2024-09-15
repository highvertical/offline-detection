<?php 

return [
    'enabled' => env('OFFLINE_DETECTION_ENABLED', true), // Toggle based on environment
    'timeout' => env('OFFLINE_DETECTION_TIMEOUT', 5000), // Time in milliseconds (5 seconds)
];
