self.addEventListener('install', e => {
    self.skipWaiting();
});

self.addEventListener('activate', e => {
    self.clients.claim();
});

self.addEventListener('push', event => {
  const data = event.data.json();

  event.waitUntil(
    self.registration.showNotification(
      data.notification.title,
      data.notification
    )
  );
});

self.addEventListener('notificationclick', event => {
  event.notification.close();
  event.waitUntil(
    clients.openWindow(event.notification.data.url)
  );
});

