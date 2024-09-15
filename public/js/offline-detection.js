document.addEventListener('DOMContentLoaded', function () {
    let timeout = 5000; // Time in milliseconds

    function handleConnectionStatus() {
        setTimeout(function () {
            if (navigator.onLine) {
                handleReconnection();
            } else {
                handleDisconnection();
            }
        }, timeout);
    }

    function handleDisconnection() {
        showConnectionBanner('You are offline', false);
    }

    function handleReconnection() {
        showConnectionBanner('You are back online!', true);
        syncOfflineData();
    }

    function showConnectionBanner(message, isOnline) {
        let banner = document.getElementById('connection-status');

        if (!banner) {
            banner = document.createElement('div');
            banner.id = 'connection-status';
            banner.style.position = 'fixed';
            banner.style.top = '0';
            banner.style.width = '100%';
            banner.style.textAlign = 'center';
            banner.style.padding = '10px';
            banner.style.zIndex = '9999';
            banner.style.fontFamily = 'Arial, sans-serif';
            document.body.appendChild(banner);
        }

        banner.textContent = message;
        banner.style.backgroundColor = isOnline ? '#4caf50' : '#ffcc00'; // Green for online, yellow for offline
        banner.style.color = '#fff';
        banner.style.display = 'block';

        // Automatically hide banner after 5 seconds if online
        if (isOnline) {
            setTimeout(function () {
                banner.style.display = 'none';
            }, 5000);
        }
    }

    function syncOfflineData() {
        let unsentData = JSON.parse(localStorage.getItem('offlineData')) || [];

        // If there is data to be synced, send it to the server
        if (unsentData.length > 0) {
            unsentData.forEach(data => {
                sendDataToServer(data).then(response => {
                    console.log('Data synced:', response);
                    // Clear localStorage after syncing
                    localStorage.removeItem('offlineData');
                }).catch(error => {
                    console.error('Failed to sync data:', error);
                });
            });
        }
    }

    function sendDataToServer(data) {
        return new Promise((resolve, reject) => {
            // Simulate a server request
            setTimeout(() => {
                resolve('Success');
            }, 1000);
        });
    }

    // Listen for connection status changes
    window.addEventListener('online', handleConnectionStatus);
    window.addEventListener('offline', handleConnectionStatus);

    // Check the connection status on page load
    handleConnectionStatus();
});
