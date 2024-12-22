const logout = () => {
    document.addEventListener("DOMContentLoaded", () => {
        const logoutButton = document.getElementById("logout-btn");
        const token = localStorage.getItem("auth_token");
        const csrfToken = document.querySelector(
            'meta[name="csrf-token"]'
        ).content;

        logoutButton.addEventListener("click", async () => {
            try {
                if (token) {
                    const response = await fetch("/api/logout", {
                        method: "POST",
                        credentials: "include",
                        headers: {
                            "Content-Type": "application/json",
                            Accept: "application/json",
                            Authorization: `Bearer ${token}`,
                            "X-CSRF-TOKEN": csrfToken,
                        },
                    });
                    if (response.ok) {
                        const data = await response.json();
                        localStorage.removeItem("auth_token");
                        alert(data.message || "ログアウト成功");
                        window.location.href = "/";
                    } else {
                        const errorData = await response.json();
                        alert(
                            "ログアウト失敗: " +
                                (errorData.message || "エラーが発生しました")
                        );
                    }
                }
            } catch (error) {
                throw new Error("エラーが発生しました。", error);
            }
        });
    });
};
logout();
