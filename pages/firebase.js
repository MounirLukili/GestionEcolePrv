// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-app.js";
import { getFirestore, collection, doc, setDoc } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js";
import { getStorage, ref, uploadBytes, getDownloadURL } from "https://www.gstatic.com/firebasejs/10.10.0/firebase-storage.js";


// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "",
  authDomain: "esio-b625c.firebaseapp.com",
  projectId: "esio-b625c",
  storageBucket: "esio-b625c.appspot.com",
  messagingSenderId: "928204244790",
  appId: "1:928204244790:web:b0a9dd3d520d8291ac9597"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const storage = getStorage(app);

document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('form');
  form.addEventListener('submit', async (e) => {
    e.preventDefault();

    // Object to hold form data
    const candidatureData = {
      firstname: document.getElementById('fname').value,
      lastname: document.getElementById('lname').value,
      phone: document.getElementById('phone').value,
      email: document.getElementById('email').value,
      level: document.getElementById('level').value,
      levelOther: document.getElementById('level-autre').value,
      etablissement: document.getElementById('etablissement').value,
      ville: document.getElementById('ville').value,
      filiere: document.getElementById('filiere').value,
      datediplome: document.getElementById('datediplome').value,
      // Additional form fields as needed
    };

    console.log(candidatureData);

    try {
      // Generate a unique ID for the candidature
      const candidatureRef = doc(collection(db, "candidatures"));
      const candidatureId = candidatureRef.id; // This is the unique ID
      
      /*// Serialize candidatureData to JSON and save in the Data folder in Storage
      const dataBlob = new Blob([JSON.stringify(candidatureData)], {type: 'application/json'});
      const dataPath = `candidatures/${candidatureId}/Data/candidatureData.json`;
      const dataRef = ref(storage, dataPath);
      await uploadBytes(dataRef, dataBlob);*/
     

      // Convert candidatureData to a plain text string
      const dataString = JSON.stringify(candidatureData, null, 2); // Nicely formatted JSON as plain text
      const textBlob = new Blob([dataString], { type: 'text/plain' });

      // Define the path in Firebase Storage for the plain text document
      const textDataPath = `candidatures/${candidatureId}/Data/candidatureData.txt`;
      const textDataRef = ref(storage, textDataPath);

      // Upload the plain text Blob
      await uploadBytes(textDataRef, textBlob);
      



      // Process file uploads and store URLs in candidatureData
      const fileInputIds = ['cv', 'note1', 'motiv'];
      for (const inputId of fileInputIds) {
        const fileInput = document.getElementById(inputId);
        if (fileInput && fileInput.files[0]) {
          const file = fileInput.files[0];
          // Modify the file path to include the candidatureId
          const filePath = `candidatures/${candidatureId}/${inputId}/${file.name}`;
          const fileRef = ref(storage, filePath);
          await uploadBytes(fileRef, file);
          const url = await getDownloadURL(fileRef);
          candidatureData[inputId] = url; // Store file URL in candidatureData
        }
      }

      // Save the candidature data, including file URLs and candidate information, to Firestore
      await setDoc(candidatureRef, candidatureData);
      console.log("Candidature successfully submitted!");
      // Handle success, such as showing a message or redirecting
    } catch (error) {
      console.error("Error submitting candidature: ", error);
      // Handle error, such as showing a message to the user
    }
  });
});
