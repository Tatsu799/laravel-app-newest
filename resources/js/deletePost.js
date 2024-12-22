export const deletePost = () => {
    const token = localStorage.getItem("auth_token");
    const deleteBtns = document.querySelectorAll(".delete-btn");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    try {
        deleteBtns.forEach((deleteBtn) => {
            const postId = deleteBtn.dataset.postId;

            deleteBtn.addEventListener("click", async () => {
                if (!confirm("本当に削除してもいいですか？")) {
                    return;
                }

                const response = await fetch(`/api/${postId}/edit`, {
                    method: "DELETE",
                    credentials: "include",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                        Authorization: `Bearer ${token}`,
                    },
                });
                if (response.ok) {
                    window.location.reload();
                } else {
                    alert("削除する権限がありません。");
                }
            });
        });
    } catch (err) {
        console.error("エラーが発生しました", err);
    }
};
deletePost();
