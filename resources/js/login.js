const loginUser = () => {
    document.addEventListener("DOMContentLoaded", () => {
        const loginButton = document.getElementById("login-btn");
        const text = document.getElementById("login-text");
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        loginButton.addEventListener("click", async () => {
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            try {
                const response = await fetch("/api/loginUser", {
                    method: "POST",
                    credentials: "include",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({ email, password }),
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
loginUser();
