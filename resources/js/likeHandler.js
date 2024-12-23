export const likeHandler = () => {
    const likeButtons = document.querySelectorAll(".like-button");
    const token = localStorage.getItem("auth_token");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    likeButtons.forEach((button) => {
        if (button.dataset.liked === "true") {
            button.style.fontWeight = "700";
        } else {
            button.style.fontWeight = "400";
        }

        button.addEventListener("click", async () => {
            const postId = button.dataset.postId;
            const isLiked = button.dataset.liked === "true";
            const url = `/api/posts/${postId}/like`;
            const method = isLiked ? "DELETE" : "POST";
            const response = await fetch(url, {
                method: method,
                credentials: "include",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    Authorization: `Bearer ${token}`,
                },
            });

            if (response.ok) {
                const result = await response.json();
                button.dataset.liked = !isLiked;
                const ele = button.querySelector(".like-text");
                ele.textContent = `${result.likes_count} Likes`;

                if (!isLiked) {
                    ele.style.fontWeight = "700";
                } else {
                    ele.style.fontWeight = "400";
                }
            }
        });
    });
};
likeHandler();
