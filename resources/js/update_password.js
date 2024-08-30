document.addEventListener("DOMContentLoaded", function () {
    const currentPasswordInput = document.querySelector("#current_password");
    const feedback = document.querySelector(".error-message");
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    currentPasswordInput.addEventListener("input", async function () {
        const currentPassword = currentPasswordInput.value;

        if (currentPassword.length > 0) {
            const data = await http.post(
                "password/validate-current",
                { current_password: currentPassword },
                csrfToken
            );

            if (data.valid) {
                feedback.textContent = "Current password is correct.";
                feedback.style.color = "green";
            } else {
                feedback.textContent = "Current password is incorrect.";
                feedback.style.color = "red";
            }
        } else {
            errorMessage.textContent = "";
        }
    });
});
