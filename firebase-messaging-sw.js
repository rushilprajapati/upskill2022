// Scripts for firebase and firebase messaging
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing the generated config
var firebaseConfig = {
    apiKey: "AIzaSyDRJGI73Lu3qdIFBzisAwx4_eWywx_MC5k",
    authDomain: "upskill-laravel.firebaseapp.com",
    databaseURL: "https://upskill-laravel.firebaseio.com",
    projectId: "upskill-laravel",
    storageBucket: "upskill-laravel.appspot.com",
    messagingSenderId: "606580042666",        
    appId: "1:606580042666:web:376aa5a188f7693aa419d3"
};

firebase.initializeApp(firebaseConfig);

// Retrieve firebase messaging
const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
  console.log('Received background message ', payload);

  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});