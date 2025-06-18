window.Echo.channel('chat-channel')
    .listen('.message.sent', (e) => {
        let messageDiv = document.createElement('div');
        messageDiv.textContent = e.message;
        document.getElementById('messages').appendChild(messageDiv);
    });

document.getElementById('send-btn').addEventListener('click', () => {
    console.log("Send clicked!");
    const message = document.getElementById('message-input').value;
    console.log("Message:", message);

    fetch('/freelancer/chat/send-message', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ message: message })
    }).then(response => {
        console.log("Response:", response);
        return response.json();
    }).then(data => {
        console.log("Response data:", data);
    }).catch(error => {
        console.error("Fetch error:", error);
    });
});

