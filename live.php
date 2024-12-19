<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eye-Catching Chatbot</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.chatbot-container {
    width: 350px;
    background-color: #ffffff;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease-in-out;
}

.chatbot-container:hover {
    transform: translateY(-10px);
}

.chatbot-header {
    background-color: #007bff;
    color: white;
    padding: 15px;
    text-align: center;
    font-weight: bold;
    font-size: 18px;
}

.chatbot-body {
    padding: 15px;
    max-height: 300px;
    overflow-y: auto;
    background-color: #f9f9f9;
}

.chat-messages {
    margin-bottom: 10px;
}

.chat-message {
    margin-bottom: 10px;
}

.chatbot-footer {
    padding: 10px;
    background-color: #f1f1f1;
    display: flex;
    align-items: center;
}

#userInput {
    width: 80%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    outline: none;
    font-size: 14px;
}

#sendBtn {
    width: 18%;
    padding: 8px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background-color 0.3s ease-in-out;
}

#sendBtn:hover {
    background-color: #0056b3;
}

.send-icon {
    margin-left: 5px;
    font-size: 18px;
}

</style>
</head>
<body>
    
    <div class="chatbot-container">
        <div class="chatbot-header">
            <h2>Chat with Us</h2>
        </div>
        <div class="chatbot-body">
            <div class="chat-messages">
                <!-- Messages will be dynamically added here -->
            </div>
        </div>
        <div class="chatbot-footer">
            <input type="text" id="userInput" placeholder="Type a message...">
            <button id="sendBtn">Send</button>
        </div>
    </div>
    <script>
        document.getElementById('sendBtn').addEventListener('click', sendMessage);
document.getElementById('userInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault(); // Prevent default action (form submission)
        sendMessage();
    }
});

function sendMessage() {
    const userInput = document.getElementById('userInput').value.trim();

    if (userInput === '') {
        return;
    }

    // Add user message
    addMessage('user', userInput);

    // Generate AI response
    const aiResponse = generateAIResponse(userInput);
    addMessage('ai', aiResponse);
    
    // Clear input field
    document.getElementById('userInput').value = '';
}

function addMessage(sender, message) {
    const chatMessages = document.querySelector('.chat-messages');
    const messageElement = document.createElement('div');
    messageElement.classList.add('chat-message', sender);
    messageElement.innerHTML = `<strong>${sender === 'user' ? 'You' : 'AI'}</strong>: ${message}`;
    chatMessages.appendChild(messageElement);

    // Scroll to bottom
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function generateAIResponse(userInput) {
    const responses = [
        "Hello! How can I assist you today?",
        "I'm here to help with any questions you have.",
        "Let me look that up for you.",
        "Is there something specific you'd like to know?",
        "How can I help you today?",
        "Can you provide more details on what you need?",
        "What's your query about?",
        "Looking forward to assisting you.",
        "Do you have any other questions?",
        "Feel free to ask anything."
    ];
    return responses[Math.floor(Math.random() * responses.length)];
}

    </script>
</body>
</html>
