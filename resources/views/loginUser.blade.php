<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ログイン</title>
    @vite(['resources/css/app.css', 'resources/js/login.js'])
</head>
@if(Auth::check())
    <script>window.location = "{{ route('posts.index') }}";</script>
@endif
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <p id="login-text" class="mb-3" style="display: none; color: red; font-weight: bold">ログイン失敗。入力内容を確認してください</p>
        <h1 class="text-2xl font-bold mb-4">ログイン</h1>
        <form id="login-form">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">メールアドレス</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">パスワード</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
            </div>
            <button type="button" id="login-btn" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500 focus:ring-opacity-50">
                ログイン
            </button>
        </form>
    </div>
</body>
</html>
