importScripts(
    "https://www.gstatic.com/firebasejs/11.9.1/firebase-app-compat.js",
);

importScripts(
    "https://www.gstatic.com/firebasejs/11.9.1/firebase-messaging-compat.js",
);

firebase.initializeApp({
    apiKey: "AIzaSyBdPdHIw7cztf3XW0PcFlWjWttn_avXqFs",
    authDomain: "ktr-erp-93295.firebaseapp.com",
    projectId: "ktr-erp-93295",
    storageBucket: "ktr-erp-93295.firebasestorage.app",
    messagingSenderId: "184845407310",
    appId: "1:184845407310:web:501aa6dba1362784d35f1f",
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function (payload) {
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: "/favicon.ico",
    });
});
