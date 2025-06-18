{{-- <!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <h1>Laravel Real-Time Chat</h1>

    <input type="text" id="message-input" placeholder="Type message..." />
    <button id="send-btn">Send</button>

    <div id="messages"></div>



</body>

</html> --}}
@extends('layouts.master')
@section('title', __('create_country'))
@section('content')
<div class="container">
    <h3>Real-Time Chat</h3>

    <div class="card">
        <div class="card-body" id="messages" style="height: 350px; overflow-y: scroll; border: 1px solid #ccc; padding: 10px;">
            {{-- هنا رسائل الشات --}}
        </div>

        <div class="mt-3">
            <input type="hidden" id="chat-id" value="{{ $chatId }}">
            <textarea id="message-input" class="form-control" placeholder="اكتب رسالتك..."></textarea>
            <button id="send-btn" class="btn btn-primary mt-2">Send</button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script src="{{ asset('js/echo.js') }}"></script>

<script>
    Pusher.logToConsole = true;

    window.Echo = new Echo({
        broadcaster: 'pusher',
        key: '{{ env("PUSHER_APP_KEY") }}',
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        forceTLS: true
    });

    const chatId = document.getElementById('chat-id').value;
    const messagesDiv = document.getElementById('messages');

    // جلب الرسائل القديمة
    fetch(`/api/chat/${chatId}/messages`, {
        headers: {
            'Authorization': 'Bearer {{ auth()->user()->api_token }}'
        }
    })
    .then(response => response.json())
    .then(messages => {
        messages.forEach(msg => {
            appendMessage(msg);
        });
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    });

    // استماع للرسائل الجديدة
    window.Echo.private(`chat.${chatId}`)
        .listen('.new-message', (e) => {
            appendMessage(e.message);
        });

    // إرسال رسالة
    document.getElementById('send-btn').addEventListener('click', function () {
        const messageText = document.getElementById('message-input').value;

        if (messageText.trim() === '') return;

        fetch('/api/chat/send-message', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer {{ auth()->user()->api_token }}',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                chat_id: chatId,
                message: messageText
            })
        }).then(response => response.json())
        .then(data => {
            document.getElementById('message-input').value = '';
        });
    });

    // دالة لعرض الرسائل
    function appendMessage(msg) {
        const div = document.createElement('div');
        div.style.margin = '5px 0';
        div.style.padding = '8px';
        div.style.borderRadius = '10px';
        div.style.maxWidth = '70%';

        if (msg.sender_id == {{ auth()->id() }}) {
            div.style.background = '#cce5ff';
            div.style.marginLeft = 'auto';
        } else {
            div.style.background = '#e2e3e5';
            div.style.marginRight = 'auto';
        }

        let content = `<strong>${msg.sender.name}</strong><br>${msg.message}`;

        // لو في مرفق
        if (msg.attachment_url) {
            content += `<br><a href="${msg.attachment_url}" target="_blank">📎 مرفق ${msg.attachment_type}</a>`;
        }

        // read status
        if (msg.is_read && msg.sender_id == {{ auth()->id() }}) {
            content += `<br><small style="color:green;">✓ تم القراءة</small>`;
        }

        div.innerHTML = content;
        messagesDiv.appendChild(div);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }
</script>
@endpush
