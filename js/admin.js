document.addEventListener('DOMContentLoaded', async function () {
    const coachDataDiv = document.getElementById('coachData');

    // Fetch coach data from Firestore
    const coachesRef = db.collection('coaches');
    const coachesSnapshot = await coachesRef.get();

    coachesSnapshot.forEach((doc) => {
        const coachData = doc.data();
        const coachElement = createCoachElement(doc.id, coachData);
        coachDataDiv.appendChild(coachElement);
    });

    function createCoachElement(coachId, coachData) {
        const coachElement = document.createElement('div');
        coachElement.innerHTML = `
        <strong>${coachData.coachName}</strong><br>
        Email: ${coachData.email}<br>
        Contact Number: ${coachData.contactNumber}<br>
        Qualifications: ${coachData.qualifications}<br>
        Available Days: ${coachData.availableDays}<br>
        Available Time: ${coachData.availableTimeFrom} - ${coachData.availableTimeTo}<br>
        <img class="coach-photo" src="${coachData.coachPhoto}" alt="Coach Photo"> 
        <a href="${coachData.qualificationsProof}" target="_blank">View Qualifications Proof</a>
        <!-- Add more fields as needed -->
        <br>
    `;

        // Add UI elements for updating and deleting data
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.addEventListener('click', async () => {
            if (confirm('Are you sure you want to delete this coach data?')) {
                await coachesRef.doc(coachId).delete();
                coachElement.remove();
            }
        });

        const updateButton = document.createElement('button');
        updateButton.textContent = 'Update';
        updateButton.addEventListener('click', () => {
            showUpdateForm(coachId, coachData);
        });

        const acceptButton = document.createElement('button');
        acceptButton.textContent = 'Accept';
        acceptButton.addEventListener('click', () => {
            acceptCoachData(coachData);
        });

        coachElement.appendChild(deleteButton);
        coachElement.appendChild(updateButton);
        coachElement.appendChild(acceptButton);

        return coachElement;
    }

    async function deleteCoachData(coachId, coachPhotoUrl) {
        // Delete coach data from Firestore
        await coachesRef.doc(coachId).delete();

        // Delete coach photo from Firebase Storage
        const storageRef = firebase.storage().refFromURL(coachPhotoUrl);
        await storageRef.delete();
    }


    function showUpdateForm(coachId, coachData) {
   
    }

    function acceptCoachData(coachData) {
        // Save the accepted coach data in local storage
        localStorage.setItem('acceptedCoachData', JSON.stringify(coachData));

        // Redirect to the separate page for displaying accepted coach data
        window.location.href = 'accepted-coach-page.html';
    }
});
