import { likeHandler } from "./likeHandler";
import { deletePost } from "./deletePost";

const getPostsData = () => {
    const token = localStorage.getItem("auth_token");
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    document.addEventListener("DOMContentLoaded", async (event) => {
        event.preventDefault();

        try {
            const postResponse = await fetch("/api/posts", {
                method: "GET",
                credentials: "include",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                    Authorization: `Bearer ${token}`,
                },
            });

            const data = await postResponse.json();
            console.log(data);

            if (postResponse.ok) {
                if (data.body.length !== 0) {
                    const postList = document.getElementById("postList");
                    postList.innerHTML = "";
                    data.body.forEach(async (post) => {
                        // 投稿の日付をフォーマット
                        const date =
                            "posted at " +
                            post.created_at.slice(0, 10) +
                            " " +
                            post.created_at.slice(11, 16);

                        const div = document.createElement("div");
                        div.classList.add("max-w-lg", "mx-auto", "pb-6");
                        div.innerHTML = `
                                <div class="flex bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                                    <div>
                                        <p id="content" class="text-gray-600 mt-2">${
                                            post.text
                                        }</p>
                                        <span class="text-sm text-gray-500">${date}</span>
                                        <div class="flex mt-2">
                                            <button class="like-button" data-post-id="${
                                                post.id
                                            }" data-liked="${
                            post.isLiked
                        }" data-isOwner="${post.is}">
                                                <span class="like-text">${
                                                    post.likes_count
                                                } Likes</span>
                                            </button>

                                        </div>
                                    </div>
                                    <div class="ml-auto">
                                        <form class="update-btn relative top-1 right-4 bg-indigo-900 text-white py-1 px-3 rounded-full shadow-lg hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition ease-in-out duration-200" method="GET" action="${
                                            post.id
                                        }/edit" style="display: ${
                            post.isOwner ? "block" : "none"
                        }">
                                            <button type="submit">編集</button>
                                        </form>

                                        <button type="submit" class="delete-btn relative top-4 right-4 bg-red-500 text-white py-1 px-3 rounded-full shadow-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 transition ease-in-out duration-200" data-post-id="${
                                            post.id
                                        }" style="display: ${
                            post.isOwner ? "block" : "none"
                        }">削除</button>
                                    </div>
                                </div>
                            `;
                        postList.appendChild(div);
                    });
                    likeHandler();
                    deletePost();
                } else {
                    throw new Error("投稿がありません");
                }
            } else {
                throw new Error("投稿の取得に失敗しました");
            }
        } catch (error) {
            throw new Error("エラーが発生しました", error);
        }
    });
};
getPostsData();
