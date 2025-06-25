@extends('layouts.master')
@section('title', 'Chats')
@push('styles')
    <style>
        .list-group-item {
            border: none;
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.2s ease;
        }

        .list-group-item:hover {
            background-color: #f7f7f7;
        }

        h6 {
            font-weight: 600;
        }

        p {
            font-size: 0.9rem;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <h3 class="mb-4">Chats</h3>
        <div class="list-group">
            @foreach ($chats as $chat)
                @php
                    $otherUser = $chat->user_id_one == auth()->id() ? $chat->userTwo : $chat->userOne;
                    $lastMessage = $chat->lastMessage;
                @endphp

                <a href="{{ route('freelancer.chat.show', $chat->id) }}"
                    class="list-group-item list-group-item-action d-flex align-items-center">
                    <img src="{{ $otherUser->profile_image ?? asset('default-avatar.png') }}" alt="Avatar"
                        class="rounded-circle me-3" width="50" height="50">

                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-1">{{ $otherUser->name }}</h6>
                            @if ($lastMessage)
                                <small class="text-muted">{{ $lastMessage->created_at->diffForHumans() }}</small>
                            @endif
                        </div>
                        <p class="mb-0 text-muted">
                            {{ $lastMessage ? \Illuminate\Support\Str::limit($lastMessage->body, 50) : 'No messages yet' }}
                        </p>
                    </div>
                </a>
            @endforeach

            @if ($chats->isEmpty())
                <div class="text-center p-5 text-muted">No chats yet.</div>
            @endif
        </div>
    </div>
@endsection
