@extends('layouts.master')
@section('title', 'Chats')

@section('content')
    <div class="max-w-4xl mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">My Chats</h2>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            @forelse($chats as $chat)
                @php
                    $otherUser = $chat->user_id_one === auth()->id() ? $chat->userTwo : $chat->userOne;
                @endphp

                <a href="{{ route('freelancer.chat.show', $chat->id) }}"
                    class="flex items-center px-4 py-3 border-b hover:bg-gray-50 transition">

                    <div class="flex-shrink-0">
                        <img src="{{ $otherUser->profile_image_url ?? asset('images/default-avatar.png') }}" alt="Avatar"
                            class="w-12 h-12 rounded-full object-cover">
                    </div>

                    <div class="flex-1 ml-4">
                        <div class="flex items-center justify-between">
                            <h4 class="text-lg font-medium text-gray-800">{{ $otherUser->name }}</h4>
                            <span class="text-sm text-gray-500">
                                {{ $chat->updated_at->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 truncate">
                            {{ optional($chat->lastMessage)->message ?? 'Start your conversation' }}
                        </p>
                    </div>

                    @if ($chat->messages->where('is_read', 0)->where('receiver_id', auth()->id())->count())
                        <span
                            class="ml-3 flex items-center justify-center w-6 h-6 text-xs font-bold bg-green-500 text-white rounded-full">
                            {{ $chat->messages->where('is_read', 0)->where('receiver_id', auth()->id())->count() }}
                        </span>
                    @endif
                </a>
            @empty
                <p class="p-6 text-center text-gray-600">No chats yet.</p>
            @endforelse
        </div>
    </div>
@endsection
