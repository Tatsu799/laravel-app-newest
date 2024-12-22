<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>投稿一覧</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/logout.js','resources/js/getPostsData.js', 'resources/js/postData.js', 'resources/js/getPostsData.js'])
</head>

<body class="bg-gray-100">
    <header class="bg-white dark:bg-gray-500 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-center text-white">
            {{-- <a href="{{ route("dashboard") }}" class="mr-10">home</a>
            <a href="{{ route("dashboard") }}" class="ml-10 mr-10" >posts</a> --}}
            {{-- @if(Auth::check()) --}}
            <button id="logout-btn" class="ml-10">logout</button>
            {{-- <a href="{{ route("login") }}" class="ml-10" >logout</a> --}}
            {{-- @endif --}}
        </div>
    </header>
    {{-- <div class="container mx-auto p-6">
        <div class="bg-white p-8 mb-10 rounded shadow-md w-full mx-auto max-w-lg">
            <p class="text-gray-600 mb-6">こんにちは、、、さん</p>
        </div>
    </div> --}}

    <div class="container mx-auto p-6">
        <div class="bg-white p-8 mb-10 rounded shadow-md w-full mx-auto max-w-lg">
            <p id="alert-text" class="mb-3" style="display: none; color: red; font-weight: bold">投稿内容を入力してください。</p>
            <p class="text-gray-600 mb-6">投稿してみよう！</p>
                <from id="post-form" >
                @csrf
                <div class="mb-4">
                    <textarea id="post-text" name="text" rows="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                </div>
                <button id="post-btn" type="submit"
                    class="w-full bg-indigo-900 text-white py-2 rounded-md hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-800 focus:ring-opacity-50">
                    投稿
                </button>
            </from>
        </div>

        <h1 class="text-2xl font-semibold text-center mb-8">投稿一覧</h1>
        <div id="postList"></div>
    </div>
</body>

</html>


{{-- <x-app-layout>
    <div class='max-w-xl mx-auto p-4'>
        @if(session('message'))
            <div class="w-full bg-red-100 text-red-400 p-2 mb-6 rounded">
                {{ session('message') }}
            </div>
        @endif
        <form method="POST" action="{{ route('posts.store')}}">
            @csrf
            <div class='flex'>
                <x-text-input name="content" placeholder="What's Happening?" class="w-full"></x-text-input>
                <x-primary-button class='ml-px'>Post</x-primary-button>
            </div>
            <div>
                <x-input-error :messages="$errors->get('content')"></x-input-error>
            </div>
        </form>
        <div class='mt-6'>
            @foreach ($posts as $post)
            <div class='mt-2 p-6 bg-white border-2 border-b-gray-400 rounded-t flex justify-between'>
                <div>
                    <span class='text-gray-600'>{{ $post->user->name }}</span>
                    {{-- <div class='mt-l text-lg'>{{ $post->content }}</div> --}}
                    {{-- <div class='mt-l text-lg'>
                        {{ $post->content }}
                        @unless ($post->created_at->eq($post->updated_at))
                        <span class='text-sm text-grey-600 ml-auto'>(edited)</span>
                        @endunless
                    </div>

                    <div>
                        @if ($post->isLikedBy(auth()->user()))
                            <form action="{{ route('posts.unlike', $post)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">いいねを取り消す</button>
                            </form>
                        @else
                        <form action="{{ route('posts.like', $post)}}" method="POST">
                            @csrf
                            <button type="submit">いいね</button>
                        </form>
                        @endif
                        <p>いいね数: {{ $post->Likes->count() }}</p>
                    </div>
                </div>
                @if ($post->user->is(auth()->user()))
                <div class='ml-auto mt-auto'>
                    <form method="GET" action="{{ route('posts.edit', $post) }}">
                        <x-secondary-button type='submit'>Edit</x-secondary-button>
                    </form>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout> --}}
 {{-- }} --}}

         {{-- <div id="postList"> --}}
            {{-- いいねを追加　仮 --}}
            {{-- @foreach ($posts as $post) --}}
            {{-- @if ($post->isLikedBy(Auth::user()))
            <form method="POST" action="{{ route('posts.unlike', $post->id) }}">
                @csrf
                @method('DELETE')
                <div class="flex mt-2">
                    <button type="submit">いいねを取り消す</button>
                </div>
            </form>
            @else
            <form method="POST" action="{{ route('posts.like', $post->id) }}">
                @csrf
                <div class="flex mt-2">
                    <button type="submit">いいね</button>
                </div>
            </form>
            @endif
            <p>10 {{ $post->likes->count() }}</p>
            @endforeach --}}
        {{-- </div> --}}
