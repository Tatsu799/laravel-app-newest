<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ユーザー登録</title>
    @vite(['resources/css/app.css', 'resources/js/registerUser.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <p id="register-text" class="mb-3" style="display: none; color: red; font-weight: bold">登録失敗。入力内容を確認してください</p>
        <h1 class="text-2xl font-bold mb-4">ユーザー登録</h1>
        <form>
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">名前</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">パスワード確認</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>
            <button id="register-btn" type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                登録
            </button>
        </form>
    </div>
</body>
</html>
