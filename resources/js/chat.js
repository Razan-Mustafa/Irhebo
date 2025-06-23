import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// إعداد axios بشكل افتراضي
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// إعداد Pusher و Echo
window.Pusher = Pusher;

const echo = new Echo({
  broadcaster: 'pusher',
  key: import.meta.env.VITE_PUSHER_APP_KEY,
  cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
  forceTLS: true,
});

document.addEventListener('DOMContentLoaded', () => {
  const chatBody = document.getElementById('chatBody');
  const sendMessageForm = document.getElementById('sendMessageForm');
  const messageInput = document.getElementById('messageInput');

  if (!chatBody || !sendMessageForm || !messageInput) {
    console.warn('Chat elements missing in DOM');
    return;
  }

  // Scroll to bottom initially
  chatBody.scrollTop = chatBody.scrollHeight;

  // متغير chatId لازم توصله من صفحة Blade ديناميكياً
  // مثلاً: window.chatId = {{ $chat->id }};
  if (!window.chatId) {
    console.error('chatId is not defined on window object!');
    return;
  }

  // الاستماع للرسائل الجديدة من البث
  echo.channel('chat.' + window.chatId)
    .listen('.message.sent', (e) => {
      const bubble = document.createElement('div');
      bubble.classList.add('flex', e.message.sender_id == window.LaravelUserId ? 'justify-end' : 'justify-start');

      const content = `
        <div class="max-w-xs p-3 rounded-lg ${
          e.message.sender_id == window.LaravelUserId ? 'bg-primary text-white' : 'bg-white border'
        }">
          <p class="text-sm">${e.message.message}</p>
          <span class="block text-xs text-gray-400 mt-1">${new Date(e.message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</span>
        </div>
      `;

      bubble.innerHTML = content;
      chatBody.appendChild(bubble);
      chatBody.scrollTop = chatBody.scrollHeight;
    });

  // إرسال الرسالة عبر Axios و AJAX
  sendMessageForm.addEventListener('submit', function(e) {
    e.preventDefault();

    const message = messageInput.value.trim();
    if (message === '') return;

    axios.post(`/freelancer/chat/send-message/${window.chatId}`, { message })
      .then(response => {
        messageInput.value = '';
        chatBody.scrollTop = chatBody.scrollHeight;
      })
      .catch(error => {
        console.error(error);
        alert('Failed to send message.');
      });
  });
});
