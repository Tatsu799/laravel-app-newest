const registerUser = () => {
    document.addEventListener("DOMContentLoaded", () => {
        const registerButton = document.getElementById("register-btn");
        const text = document.getElementById("register-text");
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        registerButton.addEventListener("click", async (event) => {
            event.preventDefault();
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            try {
                const response = await fetch("/api/registerUser", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ name, email, password }),
                    credentials: "include",
                });

                if (response.ok) {
                    const data = await response.json();
                    localStorage.setItem("auth_token", data.token);
                    window.location.href = "/posts";
                } else {
                    text.style.display = "block";
                }
            } catch (error) {
                throw new Error("エラーが発生しました。", error);
            }
        });
    });
};
registerUser();
