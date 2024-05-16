const tournamentName = document.getElementById("tournamentName");
const contactNumber = document.getElementById("contactNumber");
const email = document.getElementById("email");
const newsdetail = document.getElementById("newsdetail");
const message = document.getElementById("message");
const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

const submitForm = () => {
    if (newsdetail.value === "") {
        showMessage("News detail is required", "red");
    } else if (tournamentName.value === "") {
        showMessage("Author Name is required", "red");
    } else if (contactNumber.value === "") {
        showMessage("Contact Number is required", "red");
    }else if (contactNumber.value.length < 10) {
        showMessage("Please enter a 10-digit number", "red");
    } else if (email.value === "") {
        showMessage("Email is required", "red");
    } else if (!email.value.match(regex)) {
        showMessage("Please enter a valid email address", "red");
    }
    else {
        const formData = {
            newsdetail: newsdetail.value,
            tournamentName: tournamentName.value,
            contactNumber: contactNumber.value,
            email: email.value,
        };
        console.log(formData);
        showMessage("Form submitted successfully", "green");
        // You can add further actions here, such as sending data to a server.
    }
};

const resetForm = () => {
    document.getElementById("pnewsForm").reset();
    showMessage("", "black");
};

const showMessage = (msg, color) => {
    message.innerHTML = msg;
    message.style.color = color;
};
