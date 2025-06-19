const chatId = 1; // Your current chat ID

window.Echo.private('chat.' + chatId)
    .listen('.new-message', (e) => {
        console.log('New message received:', e);
        let messageDiv = document.createElement('div');
        messageDiv.textContent = e.message.message; // Adjust based on your event data structure
        document.getElementById('messages').appendChild(messageDiv);
    });

document.getElementById('send-btn').addEventListener('click', () => {
    const message = document.getElementById('message-input').value;

    fetch('/freelancer/chat/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ chat_id: chatId, message: message })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Message sent response:', data);
    })
    .catch(console.error);
});
