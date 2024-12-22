const postData = () => {
    const postText = document.getElementById("post-text");
    const postBtn = document.getElementById("post-btn");
    const token = localStorage.getItem("auth_token");
    const text = document.getElementById("alert-text");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    postBtn.addEventListener("click", async () => {
        if (!postText.value) {
            text.style.display = "block";
            return;
        }

        try {
            const response = await fetch("/api/posts", {
                method: "POST",
                credentials: "include",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${token}`,
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({
                    text: postText.value,
                }),
            });

            if (response.ok) {
                const data = await response.json();
                window.location.href = data.redirect;
            }
        } catch (error) {
            throw new Error("エラーが発生しました。", error);
        }
    });
};
postData();
