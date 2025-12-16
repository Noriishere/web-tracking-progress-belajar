const pushCheckbox = document.getElementById('pushNotification')

const publicKey = window.VAPID_PUBLIC_KEY

function urlBase64ToUint8Array(base64String) {
    const padding = '='.repeat((4 - base64String.length % 4) % 4)
    const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/')
    const rawData = atob(base64)
    return Uint8Array.from([...rawData].map(c => c.charCodeAt(0)))
}

async function subscribePush() {
    await navigator.serviceWorker.register('/composer-template/public/sw.js');
    const reg = await navigator.serviceWorker.ready;

    const old = await reg.pushManager.getSubscription();
    if (old) await old.unsubscribe();

    const sub = await reg.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: urlBase64ToUint8Array(window.VAPID_PUBLIC_KEY)
    });

    await fetch(window.BASE_URL + 'user/push/subscribe', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(sub)
    });
}


async function unsubscribePush() {
    const reg = await navigator.serviceWorker.ready
    const sub = await reg.pushManager.getSubscription()
    if (sub) await sub.unsubscribe()
}

if (pushCheckbox) {
    pushCheckbox.addEventListener('change', e => {
        if (e.target.checked) {
            subscribePush()
        } else {
            unsubscribePush()
        }
    })
}
