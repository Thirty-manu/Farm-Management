// Function to validate the admin login form
function validateAdmin() {
    const username = document.getElementById("admin-username").value.trim();
    const password = document.getElementById("admin-password").value.trim();

    if (username === "" || password === "") {
        alert("Please fill in all fields.");
        return false;
    }

    if (username !== "Admin" || password !== "admin123") {
        alert("Invalid admin credentials.");
        return false;
    }

    return true;
}

// Function to validate the user login form (can be reused for other forms)
function validateLogin() {
    const email = document.getElementById("login-email").value.trim();
    const password = document.getElementById("login-password").value.trim();

    if (email === "" || password === "") {
        alert("Please fill in all fields.");
        return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    return true;
}
// Function to validate the admin login form
function validateAdmin() {
    const username = document.getElementById("admin-username").value.trim();
    const password = document.getElementById("admin-password").value.trim();

    if (username === "" || password === "") {
        alert("Please fill in all fields.");
        return false;
    }

    return true; // Allow the form to submit for server-side validation
}
