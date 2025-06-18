@extends('layouts.master')
@section('title', __('create_country'))
@section('content')
    <div class="container">
        @foreach ($users as $user)
            <div>
                {{ $user->name }}
                <a href="{{ route('chats.start', $user->id) }}" class="btn btn-sm btn-success">ابدأ محادثة</a>
            </div>
        @endforeach
        <h3>محادثاتك</h3>
        <ul class="list-group">
            @forelse($chats as $chat)
                @php
                    $partner = $chat->user_id_one == auth()->id() ? $chat->userTwo : $chat->userOne;
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $partner->name }}
                    <a href="{{ route('freelancer.chats.showChat', $chat->id) }}" class="btn btn-sm btn-primary">محادثة</a>
                </li>
            @empty
                <li class="list-group-item">لا يوجد محادثات</li>
            @endforelse
        </ul>
    </div>
@endsection
