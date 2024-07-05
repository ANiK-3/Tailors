function previewProfile() {
    var fileInput = document.querySelector("input[type=file]");
    var output = document.querySelector("img");

    fileInput.addEventListener("change", function (event) {
        output.src = window.URL.createObjectURL(event.target.files[0]);
    });
}
previewProfile();
