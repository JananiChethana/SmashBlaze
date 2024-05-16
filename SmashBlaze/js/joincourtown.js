const courtName = document.getElementById("courtName");
const address = document.getElementById("address");
const contactNumber = document.getElementById("contactNumber");
const email = document.getElementById("email");
const courtPhoto = document.getElementById("courtPhoto");
const courtSize = document.getElementById("courtSize");
const availableDays = document.getElementById("availableDays");
const availableTimeFrom = document.getElementById("availableTimeFrom");
const availableTimeTo = document.getElementById("availableTimeTo");
const locationInput = document.getElementById("location");
const map = document.getElementById("map"); //map element with id="map"
const message = document.getElementById("message");
const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

const submitForm = () => {
    if (courtName.value === "") {
        showMessage("Court Name is required", "red");
    } else if (address.value === "") {
        showMessage("Address is required", "red");
    } else if (contactNumber.value === "") {
        showMessage("Contact Number is required", "red");
    } else if (contactNumber.value.length < 10) {
        showMessage("Please enter a 10-digit number", "red");
    } else if (email.value === "") {
        showMessage("Email is required", "red");
    } else if (!email.value.match(regex)) {
        showMessage("Please enter a valid email address", "red");
    } else if (courtPhoto.value === "") {
        showMessage("Court Photo is required", "red");
    } else if (courtSize.value === "") {
        showMessage("Court Size is required", "red");
    } else if (availableDays.value === "") {
        showMessage("Available Days is required", "red");
    } else {
        const userData = {
            courtName: courtName.value,
            address: address.value,
            contactNumber: contactNumber.value,
            email: email.value,
            courtPhoto: courtPhoto.value,
            courtSize: courtSize.value,
            availableDays: availableDays.value,
            availableTimeFrom: availableTimeFrom.value,
            availableTimeTo: availableTimeTo.value,
            location: locationInput.value
        };
        console.log(userData);
        showMessage("Form submitted successfully", "green");
        //sending data to a server.
    }
};

const resetForm = () => {
    document.getElementById("registrationForm").reset();
    showMessage("", "black");
};

const showMessage = (msg, color) => {
    message.innerHTML = msg;
    message.style.color = color;
};
