const chatBody = document.getElementById('chatBody');
const chatInput = document.getElementById('chatInput');
const sendButton = document.getElementById('sendButton');

// Mock AI response function
function getAIResponse(userMessage) {
  // Simulate an AI response (replace with an actual API call for a live AI backend)
  const responses = {
    hello: "Hi there! How can I assist you today?",
    help: "Sure, let me know what you need help with.",
    goodbye: "Goodbye! Have a great day!",
  };

  return responses[userMessage.toLowerCase()] || "I'm sorry, I didn't quite understand that.";
}

// Function to create a chat message element
function createMessageElement(message, sender) {
  const messageDiv = document.createElement('div');
  messageDiv.classList.add('chat-message', sender === 'user' ? 'user-message' : 'ai-message');
  messageDiv.textContent = message;
  return messageDiv;
}

// Add user and AI messages to the chat body
function appendMessage(message, sender) {
  const messageElement = createMessageElement(message, sender);
  chatBody.appendChild(messageElement);
  chatBody.scrollTop = chatBody.scrollHeight; // Auto-scroll to the bottom
}

// Handle send button click
sendButton.addEventListener('click', () => {
  const userMessage = chatInput.value.trim();
  if (!userMessage) return;

  appendMessage(userMessage, 'user'); // Display user message
  chatInput.value = '';

  // Simulate AI response
  setTimeout(() => {
    const aiResponse = getAIResponse(userMessage);
    appendMessage(aiResponse, 'ai');
  }, 500);
});

// Handle "Enter" key press
chatInput.addEventListener('keypress', (e) => {
  if (e.key === 'Enter') {
    sendButton.click();
  }
});
