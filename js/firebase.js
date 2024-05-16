const firebaseConfig = {
    apiKey: "AIzaSyBoDsVxqiKfX3nBbm7NbXhtryj4yDzb2Ns",
    authDomain: "smashblaze-web.firebaseapp.com",
    projectId: "smashblaze-web",
    storageBucket: "smashblaze-web.appspot.com",
    messagingSenderId: "1072013064905",
    appId: "1:1072013064905:web:28664df11951b45795ab18",
    measurementId: "G-J08D418K09"
  };


  // Initialize Firebase
  firebase.initializeApp(firebaseConfig); 
  const db = firebase.firestore(); 