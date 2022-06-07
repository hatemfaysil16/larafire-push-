importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
   
firebase.initializeApp({
    apiKey: "AIzaSyDyonVWLsk4OdhRgM4qmTRHrJubMSkwnfE",
    authDomain: "newtest-3002c.firebaseapp.com",
    projectId: "newtest-3002c",
    storageBucket: "newtest-3002c.appspot.com",
    messagingSenderId: "4907370071",
    appId: "1:4907370071:web:445828d9f9574b1f984512",
    measurementId: "G-ESFZZ921VK"
});
  
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});