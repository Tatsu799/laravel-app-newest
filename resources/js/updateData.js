const updateData = () => {
    document.addEventListener("DOMContentLoaded", async () => {
        const updateBtn = document.getElementById("update-btn");
        const text = document.getElementById("alert-text");
        updateBtn.addEventListener("click", async (event) => {
            event.preventDefault();
            const postId = window.location.pathname.split("/")[1];
            const updatedText = document.querySelector("#text").value;
            const token = localStorage.getItem("auth_token");
            const csrfToken = document.querySelector(
                'meta[name="csrf-token"]'
            ).content;

            try {
                const response = await fetch(`/api/${postId}/edit`, {
                    method: "PUT",
                    credentials: "include",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: `Bearer ${token}`,
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        text: updatedText,
                    }),
                });

                if (response.ok) {
                    window.location.href = "/posts";
                } else {
                    // alert("入力が正しくありません。内容を確認してください。");
                    text.style.display = "block";
                    throw new Error("Failed to update post");
                }
            } catch (error) {
                console.error("Error:", error);
            }
        });
    });
};
updateData();
