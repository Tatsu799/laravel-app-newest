export const likeHandler = () => {
    const likeButtons = document.querySelectorAll(".like-button");
    const token = localStorage.getItem("auth_token");
    likeButtons.forEach((button) => {
        button.addEventListener("click", async () => {
            const postId = button.dataset.postId;
            const isLiked = button.dataset.liked === "true";
            const url = `/api/posts/${postId}/like`;
            const method = isLiked ? "DELETE" : "POST";
            const response = await fetch(url, {
                method: method,
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                    Authorization: `Bearer ${token}`,
                },
                credentials: "include",
            });

            if (response.ok) {
                const result = await response.json();
                button.dataset.liked = !isLiked;
                button.querySelector(
                    ".like-text"
                ).textContent = `${result.likes_count} Likes`;
            }
        });
    });
};
likeHandler();
