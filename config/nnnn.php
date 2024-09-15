// Config/offline-detection.php
<?php 

return [
    'enabled' => env('OFFLINE_DETECTION_ENABLED', true), // Toggle based on environment
    'timeout' => 5000, // Time in milliseconds (5 seconds)
];