const firebaseConfig = {
    apiKey: "AIzaSyBtQ5ClNswMbNLrwSvMR491Cvn9C4gJPoI",
    authDomain: "plantillafirebasedb.firebaseapp.com",
    projectId: "plantillafirebasedb",
    storageBucket: "plantillafirebasedb.appspot.com",
    messagingSenderId: "701728781167",
    appId: "1:701728781167:web:af7e93358f25a923c9ee9a",
    measurementId: "G-63SXFF2QPV"
  };
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Make auth and firestore references
const auth = firebase.auth()
const db = firebase.firestore()