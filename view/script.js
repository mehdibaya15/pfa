document.addEventListener("DOMContentLoaded", () => {
    const passwordInput = document.getElementById("password");
    const togglePassword = document.querySelector(".toggle-password");

    togglePassword.addEventListener("click", () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            togglePassword.textContent = "👁️";
        } else {
            passwordInput.type = "password";
            togglePassword.textContent = "🙈";
        }
    });

    document.getElementById("loginForm").addEventListener("submit", function (event) {
        document.getElementById("errorMessage").textContent = "Processing login...";
    });
});
