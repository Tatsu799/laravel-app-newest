const logout = () => {
    document.addEventListener("DOMContentLoaded", () => {
        const logoutButton = document.getElementById("logout-btn");
        const token = localStorage.getItem("auth_token");

        logoutButton.addEventListener("click", async () => {
            try {
                const response = await fetch("/api/logout", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        Accept: "application/json",
                        Authorization: `Bearer ${token}`,
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    credentials: "include",
                });

                if (response.ok) {
                    const data = await response.json();
                    alert(data.message || "ログアウト成功");
                    window.location.href = "/";
                } else {
                    const errorData = await response.json();
                    alert(
                        "ログアウト失敗: " +
                            (errorData.message || "エラーが発生しました")
                    );
                }
            } catch (error) {
                throw new Error("エラーが発生しました。", error);
            }
        });
    });
};
logout();
