{{-- @extends('layouts.master')
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
@endsection --}}


<!DOCTYPE html>
<html>

<head>
    <title>Chat API Test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        textarea {
            width: 100%;
            height: 200px;
        }
    </style>
</head>

<body>

    <h2>Chat API Test</h2>

    <form id="sendMessageForm" enctype="multipart/form-data">
        <label>Chat ID:</label>
        <input type="text" name="chat_id" value="1" required><br><br>

        <label>Message:</label>
        <input type="text" name="message"><br><br>

        <label>Attachment:</label>
        <input type="file" name="attachment_file"><br><br>

        <label>Attachment Type:</label>
        <select name="attachment_type">
            <option value="">-- اختياري --</option>
            <option value="image">Image</option>
            <option value="video">Video</option>
            <option value="file">File</option>
            <option value="audio">Audio</option>
        </select><br><br>

        <button type="submit">Send Message</button>
    </form>

    <h3>Response:</h3>
    <textarea id="responseArea" readonly></textarea>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="{{ asset('js/echo.js') }}"></script> <!-- لو مركب echo.js -->

    <script>
        // إعداد Laravel Echo مع Pusher
        window.Pusher = Pusher;

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'your-pusher-key',
            cluster: 'your-pusher-cluster',
            encrypted: true,
            authEndpoint: '/broadcasting/auth',
            auth: {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    // لو تستخدم توكن، ضيف Authorization header
                    //'Authorization': 'Bearer {{ auth()->user()->api_token ?? '' }}'
                }
            }
        });

        const chatId = 1; // رقم الشات الحالي

        // الاشتراك في القناة الخاصة
        window.Echo.private('chat.' + chatId)
            .listen('.new-message', (e) => {
                console.log('New message:', e);
                let messagesDiv = document.getElementById('messages');
                let div = document.createElement('div');
                div.textContent = e.message.message;
                messagesDiv.appendChild(div);
            });

        // إرسال رسالة
        document.getElementById('send-btn').addEventListener('click', () => {
            const message = document.getElementById('message-input').value;

            fetch('/api/v1/chat/send-message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                        //'Authorization': 'Bearer your_api_token_if_needed'
                    },
                    body: JSON.stringify({
                        chat_id: chatId,
                        message: message
                    })
                })
                .then(res => res.json())
                .then(data => {
                    console.log('Message sent:', data);
                    document.getElementById('message-input').value = '';
                })
                .catch(console.error);
        });
    </script>

</body>

</html>
