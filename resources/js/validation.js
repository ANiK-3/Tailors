function signUp() {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let phone = document.getElementById("phone").value;
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let cpassword = document.getElementById("cpassword").value;

    let namePattern = "/[a-zA-Z]{3,50}/";
    let usernamePattern = "/[a-zA-Z]{3,50}/";
    let emailPattern = "/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,})$/";
    let passwordPattern =
        "/((?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*><?()*&+_])).{8,}/";
    let phonePattern = "/(+88)?-?01[3-9]d{8}/";

    if (name.length < 3) {
        alert("Name should be atleast 3 character");
        return false;
    } else if (username.length < 3 || username.length > 50) {
        alert("Name should be atleast 3 character");
        return false;
    } else if (!name.match(namePattern)) {
        alert("Name should be atleast 3 character.");
        return false;
    } else if (!email.match(emailPattern)) {
        alert("Please provide a valid email.");
        return false;
    } else if (!phone.match(phonePattern)) {
        alert("Please provide a valid phone number.");
        return false;
    } else if (!username.match(usernamePattern)) {
        alert("Please provide a valid username.");
        return false;
    } else if (!password.match(passPattern)) {
        alert("Please provide a password of at least eight characters.");
        return false;
    } else if (!cpassword.match(passwordPattern)) {
        alert("Password and confirm password does not match.");
        return false;
    }
}
