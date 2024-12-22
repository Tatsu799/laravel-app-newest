export const deletePost = () => {
    const token = localStorage.getItem("auth_token");
    const deleteBtns = document.querySelectorAll(".delete-btn");

    try {
        deleteBtns.forEach((deleteBtn) => {
            const postId = deleteBtn.dataset.postId;

            deleteBtn.addEventListener("click", async () => {
                if (!confirm("本当に削除してもいいですか？")) {
                    return;
                }

                const response = await fetch(`/api/${postId}/edit`, {
                    method: "DELETE",
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
