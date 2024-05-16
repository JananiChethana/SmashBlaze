const coachName = document.getElementById("coachName");
const contactNumber = document.getElementById("contactNumber");
const email = document.getElementById("email");
const qualifications = document.getElementById("qualifications");
const qualificationsProof = document.getElementById("qualificationsProof");
const coachPhoto = document.getElementById("coachPhoto");
const availableDays = document.getElementById("availableDays");
const availableTimeFrom = document.getElementById("availableTimeFrom");
const availableTimeTo = document.getElementById("availableTimeTo");
const message = document.getElementById("message");
const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

const resetForm = () => {
    coachName.value = "";
    contactNumber.value = "";
    email.value = "";
    qualifications.value = "";
    qualificationsProof.value = "";
    coachPhoto.value = "";
    availableDays.value = "";
    availableTimeFrom.value = "";
    availableTimeTo.value = "";
    showMessage("", "");
};

const showMessage = (msg, color) => {
    if (message) {
        message.textContent = msg;
        message.style.color = color;
    } else {
        console.error("Error: 'message' element is not defined.");
    }
};

const isEmailUnique = async (enteredEmail) => {
    const snapshot = await db.collection("coaches").where("email", "==", enteredEmail).get();
    return snapshot.empty;
};

const submitForm = async () => {
    const coachPhotoFile = coachPhoto.files[0];
    const qualificationsProofFile = qualificationsProof.files[0];

    if (!coachPhotoFile) {
        showMessage("Coach Photograph is required", "red");
    } else if (!coachPhotoFile.type.startsWith("image/")) {
        showMessage("Please upload a valid image file", "red");
    } else if (!qualificationsProofFile) {
            showMessage("Qualifications Proof document is required", "red");
    } else {
        const isUnique = await isEmailUnique(email.value);

        if (!isUnique) {
            showMessage("This email is already in use. Please use a different one.", "red");
        } else {
            const photoFileName = `${Date.now()}_${coachPhotoFile.name}`;
            const photoStorageRef = firebase.storage().ref().child(`coach_photos/${photoFileName}`);
            const photoUploadTask = photoStorageRef.put(coachPhotoFile);
            
            const qualificationsProofFileName = `${Date.now()}_${qualificationsProofFile.name}`;
            const qualificationsProofStorageRef = firebase.storage().ref().child(`qualifications_proof/${qualificationsProofFileName}`);
            const qualificationsProofUploadTask = qualificationsProofStorageRef.put(qualificationsProofFile);

            try {
                const [photoSnapshot, qualificationsProofSnapshot] = await Promise.all([photoUploadTask, qualificationsProofUploadTask]);

                const photoDownloadURL = await photoSnapshot.ref.getDownloadURL();
                const qualificationsProofDownloadURL = await qualificationsProofSnapshot.ref.getDownloadURL();

                const userData = {
                    coachName: coachName.value,
                    contactNumber: contactNumber.value,
                    email: email.value,
                    qualifications: qualifications.value,
                    qualificationsProof: qualificationsProofDownloadURL,
                    coachPhoto: photoDownloadURL,
                    availableDays: availableDays.value,
                    availableTimeFrom: availableTimeFrom.value,
                    availableTimeTo: availableTimeTo.value
                };

                await db.collection("coaches").add(userData);
                showMessage("Form submitted successfully", "green");
            } catch (error) {
                console.error("Error uploading coach photo: ", error);
                showMessage("Error submitting form", "red");
            }
        }
    }
};






/*const coachName = document.getElementById("coachName");
const contactNumber = document.getElementById("contactNumber");
const email = document.getElementById("email");
const qualifications = document.getElementById("qualifications");
const qualificationsProof = document.getElementById("qualificationsProof");
const coachPhoto = document.getElementById("coachPhoto");
const availableDays = document.getElementById("availableDays");
const availableTimeFrom = document.getElementById("availableTimeFrom");
const availableTimeTo = document.getElementById("availableTimeTo");
const message = document.getElementById("message");
const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

// Define a variable to track whether the form has been submitted
//let formSubmitted = false;

// Define the resetForm function
const resetForm = () => {
    // Check if the form has been submitted
    //if (!formSubmitted) {
        // Reset values or perform any other actions to reset the form 
        coachName.value = "";
        contactNumber.value = "";
        email.value = "";
        qualifications.value = "";
        qualificationsProof.value = "";
        coachPhoto.value = "";
        availableDays.value = "";
        availableTimeFrom.value = "";
        availableTimeTo.value = "";

        // Reset the message element
        showMessage("", ""); // You can set default values for color and message here
    //}
};

// Define the showMessage function
const showMessage = (msg, color) => {
    // Check if the message element is found
    if (message) {
        message.textContent = msg;
        message.style.color = color;
    } else {
        console.error("Error: 'message' element is not defined.");
    }
};

const isEmailUnique = async (enteredEmail) => {
    // Check if the email already exists in the database
    const snapshot = await db.collection("coaches").where("email", "==", enteredEmail).get();

    return snapshot.empty; // If true, the email is unique; otherwise, it's already in use
};

const submitForm = async () => {
    if (coachName.value === "") {
        showMessage("Coach Name is required", "red");
    } else if (contactNumber.value === "") {
        showMessage("Contact Number is required", "red");
    } else if (contactNumber.value.length < 10) {
        showMessage("Please enter a 10-digit number", "red");
    } else if (email.value === "") {
        showMessage("Email is required", "red");
    } else if (!email.value.match(regex)) {
        showMessage("Please enter a valid email address", "red");
    } else if (qualifications.value === "") {
        showMessage("Qualifications are required", "red");
    } else if (qualificationsProof.value === "") {
        showMessage("Qualifications Proof document is required", "red");
    } else if (coachPhoto.value === "") {
        showMessage("Coach Photograph is required", "red");
    } else if (availableDays.value === "") {
        showMessage("Available Days is required", "red");
    } else {
        // Check if the entered email is unique
        const isUnique = await isEmailUnique(email.value);

        if (!isUnique) {
            showMessage("This email is already in use. Please use a different one.", "red");
        } else {
            // If the email is unique, proceed to submit the form
            const userData = {
                coachName: coachName.value,
                contactNumber: contactNumber.value,
                email: email.value,
                qualifications: qualifications.value,
                qualificationsProof: qualificationsProof.value,
                coachPhoto: coachPhoto.value,
                availableDays: availableDays.value,
                availableTimeFrom: availableTimeFrom.value,
                availableTimeTo: availableTimeTo.value
            };

            // Submit the form
            db.collection("coaches").add(userData)
                .then((docRef) => {
                    console.log("Document written with ID: ", docRef.id);
                    showMessage("Form submitted successfully", "green");

                    // Update the formSubmitted variable after successful submission
                    formSubmitted = true;
                })
                .catch((error) => {
                    console.error("Error adding document: ", error);
                    showMessage("Error submitting form", "red");
                });
        }
    }
};

*/


/* const submitForm = () => {
    if (coachName.value === "") {
        showMessage("Coach Name is required", "red");
    } else if (contactNumber.value === "") {
        showMessage("Contact Number is required", "red");
    } else if (contactNumber.value.length < 10) {
        showMessage("Please enter a 10-digit number", "red");
    } else if (email.value === "") {
        showMessage("Email is required", "red");
    } else if (!email.value.match(regex)) {
        showMessage("Please enter a valid email address", "red");
    } else if (qualifications.value === "") {
        showMessage("Qualifications are required", "red");
    } else if (qualificationsProof.value === "") {
        showMessage("Qualifications Proof document is required", "red");
    } else if (coachPhoto.value === "") {
        showMessage("Coach Photograph is required", "red");
    } else if (availableDays.value === "") {
        showMessage("Available Days is required", "red");
    } else {
        const userData = {
            coachName: coachName.value,
            contactNumber: contactNumber.value,
            email: email.value,
            qualifications: qualifications.value,
            qualificationsProof: qualificationsProof.value,
            coachPhoto: coachPhoto.value,
            availableDays: availableDays.value,
            availableTimeFrom: availableTimeFrom.value,
            availableTimeTo: availableTimeTo.value
        };
        db.collection("coaches").add(userData)
            .then((docRef) => {
                console.log("Document written with ID: ", docRef.id);
                showMessage("Form submitted successfully", "green");
            })
            .catch((error) => {
                console.error("Error adding document: ", error);
                showMessage("Error submitting form", "red");
            });

    }
};
*/ 


