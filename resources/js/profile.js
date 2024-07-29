function previewProfile() {
    let fileInput = document.querySelector("input[type=file]");
    let output = document.querySelector(".profile-picture img");

    fileInput.addEventListener("change", function (event) {
        output.src = window.URL.createObjectURL(event.target.files[0]);
    });
}
previewProfile();
