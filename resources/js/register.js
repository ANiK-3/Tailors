let selectRole = document.getElementById("role");
let tailorFields = document.getElementById("tailor-fields");
let customerFields = document.getElementById("customer-fields");

// Initially hide all role-specific fields
tailorFields.style.display = "none";
customerFields.style.display = "none";

selectRole.addEventListener("change", function (event) {
    let role = event.target.value;

    // Hide all role-specific fields before showing the relevant one
    tailorFields.style.display = "none";
    customerFields.style.display = "none";

    // Show fields based on selected role
    if (role === "tailor") {
        tailorFields.style.display = "block";
    } else if (role === "customer") {
        customerFields.style.display = "block";
    }
});
