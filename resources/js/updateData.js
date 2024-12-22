const updateData = () => {
    document.addEventListener("DOMContentLoaded", async () => {
        const updateBtn = document.getElementById("update-btn");
        const text = document.getElementById("alert-text");
        updateBtn.addEventListener("click", async (event) => {
            event.preventDefault();
            const postId = window.location.pathname.split("/")[1];
            const updatedText = document.querySelector("#text").value;
            const token = localStorage.getItem("auth_token");

            try {
                const response = await fetch(`/api/${postId}/edit`, {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        Authorization: `Bearer ${token}`,
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({
                        text: updatedText,
                    }),
                    credentials: "include",
                });

                if (response.ok) {
                    window.location.href = "/posts";
                } else {
                    alert("更新する権限がありません。");
                    window.location.href = "/posts";
                    throw new Error("Failed to update post");
                }
            } catch (error) {
                console.error("Error:", error);
            }
        });
    });
};
updateData();
