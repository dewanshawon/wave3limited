const CACHE_NAME = 'wave3limited-v1.0.0';
const urlsToCache = [
  '/',
  '/?page=home',
  '/?page=services',
  '/?page=companies',
  '/?page=team',
  '/?page=contact',
  '/assets/WAVElogo01.png',
  '/manifest.json',
  'https://cdn.jsdelivr.net/npm/@heroui/react@2.7.9/dist/index.css',
  'https://cdn.tailwindcss.com',
  'https://code.iconify.design/3/3.1.0/iconify.min.js',
  'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap'
];

// Install event - cache resources
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        console.log('Opened cache');
        return cache.addAll(urlsToCache);
      })
  );
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        // Return cached version or fetch from network
        if (response) {
          return response;
        }
        
        // Clone the request because it's a stream
        const fetchRequest = event.request.clone();
        
        return fetch(fetchRequest).then(response => {
          // Check if valid response
          if (!response || response.status !== 200 || response.type !== 'basic') {
            return response;
          }
          
          // Clone the response
          const responseToCache = response.clone();
          
          caches.open(CACHE_NAME)
            .then(cache => {
              cache.put(event.request, responseToCache);
            });
          
          return response;
        });
      })
      .catch(() => {
        // Return offline page if both cache and network fail
        if (event.request.destination === 'document') {
          return caches.match('/?page=home');
        }
      })
  );
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cacheName => {
          if (cacheName !== CACHE_NAME) {
            console.log('Deleting old cache:', cacheName);
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
});

// Background sync for offline form submissions
self.addEventListener('sync', event => {
  if (event.tag === 'background-sync') {
    event.waitUntil(doBackgroundSync());
  }
});

function doBackgroundSync() {
  // Handle offline form submissions
  return fetch('/api/contact', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      // Form data would be stored in IndexedDB
    })
  });
}

// Push notification handling
self.addEventListener('push', event => {
  const options = {
    body: event.data ? event.data.text() : 'New update from Wave 3 Limited',
    icon: '/assets/WAVElogo01.png',
    badge: '/assets/WAVElogo01.png',
    vibrate: [100, 50, 100],
    data: {
      dateOfArrival: Date.now(),
      primaryKey: 1
    },
    actions: [
      {
        action: 'explore',
        title: 'View Services',
        icon: '/assets/WAVElogo01.png'
      },
      {
        action: 'close',
        title: 'Close',
        icon: '/assets/WAVElogo01.png'
      }
    ]
  };
  
  event.waitUntil(
    self.registration.showNotification('Wave 3 Limited', options)
  );
});

// Notification click handling
self.addEventListener('notificationclick', event => {
  event.notification.close();
  
  if (event.action === 'explore') {
    event.waitUntil(
      clients.openWindow('/?page=services')
    );
  } else if (event.action === 'close') {
    // Just close the notification
  } else {
    // Default action - open homepage
    event.waitUntil(
      clients.openWindow('/')
    );
  }
}); 