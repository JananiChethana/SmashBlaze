document.addEventListener('DOMContentLoaded', function () {
    const tournamentName = document.getElementById("tournamentName");
    const venue = document.getElementById("venue");
    const time = document.getElementById("time");
    const organizationName = document.getElementById("organizationName");
    const contactNumber = document.getElementById("contactNumber");
    const email = document.getElementById("email");
    const category1 = document.getElementById("category1");
    const category2 = document.getElementById("category2");
    const category3 = document.getElementById("category3");
    const category4 = document.getElementById("category4");
    const category5 = document.getElementById("category5");
    const regDocument = document.getElementById("regDocument");
    const message = document.getElementById("message");

    const resetForm = () => {
        if (tournamentName && venue && time && organizationName && contactNumber && email &&
            category1 && category2 && category3 && category4 && category5 && regDocument && message) {
            tournamentName.value = "";
            venue.value = "";
            time.value = "";
            organizationName.value = "";
            contactNumber.value = "";
            email.value = "";
            category1.value = "";
            category2.value = "";
            category3.value = "";
            category4.value = "";
            category5.value = "";
            regDocument.value = "";
            showMessage("", "");
        } else {
            console.error("Error: One or more elements are not defined.");
        }
    };

    const showMessage = (msg, color) => {
        if (message) {
            message.textContent = msg;
            message.style.color = color;
        } else {
            console.error("Error: 'message' element is not defined.");
        }
    };

    const submitForm = async () => {
        const regDocumentFile = regDocument.files[0];

        if (!regDocumentFile) {
            showMessage("Registration Document is required", "red");
        } else {
            const regDocumentFileName = `${Date.now()}_${regDocumentFile.name}`;
            const regDocumentStorageRef = firebase.storage().ref().child(`registration_documents/${regDocumentFileName}`);
            const regDocumentUploadTask = regDocumentStorageRef.put(regDocumentFile);

            try {
                const regDocumentSnapshot = await regDocumentUploadTask;

                const regDocumentDownloadURL = await regDocumentSnapshot.ref.getDownloadURL();

                const userData = {
                    tournamentName: tournamentName.value,
                    venue: venue.value,
                    time: time.value,
                    organizationName: organizationName.value,
                    contactNumber: contactNumber.value,
                    email: email.value,
                    category1: category1.value,
                    category2: category2.value,
                    category3: category3.value,
                    category4: category4.value,
                    category5: category5.value,
                    regDocument: regDocumentDownloadURL,
                    message: message.value,
                };

                // Assuming db is your Firestore database instance
                await db.collection("tournaments").add(userData);
                showMessage("Form submitted successfully", "green");
            } catch (error) {
                console.error("Error uploading registration document: ", error);
                showMessage("Error submitting form", "red");
            }
        }
    };

    const submitButton = document.getElementById("submitButton");
    if (submitButton) {
        submitButton.addEventListener('click', submitForm);
    }
});
