@extends('layouts.app')
@section('title', 'AI Services')
@section('content')
    <style>
        .chat-container {
            width: 1300px;
            margin: 50px auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .chat-box {
            height: 450px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }
        .message {
            margin: 5px 0;
            padding: 10px;
            border-radius: 10px;
        }
        .user {
            text-align: right;
            background-color: #007bff;
            color: white;
        }
        .ai {
            text-align: left;
            background-color:rgb(46, 110, 119);
            color: white;
        }
        .input-container {
            display: flex;
        }
        .input-container input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
        }
        .input-container button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h2>Discutez avec l'IA</h2>
        <div class="chat-box" id="chat-box"></div>
        <div class="input-container">
            <input type="text" id="message-input" placeholder="Tapez votre message...">
            <button onclick="sendMessage()">Envoyer</button>
        </div>
    </div>

    <script>
        async function sendMessage() {
            const input = document.getElementById('message-input');
            const message = input.value.trim();
            if (!message) return;

            const chatBox = document.getElementById('chat-box');
            chatBox.innerHTML += `<div class="message user">Vous : ${message}</div>`;
            input.value = '';
            chatBox.scrollTop = chatBox.scrollHeight;

            try {
                const response = await fetch('/ai-services/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message })
                });
                const data = await response.json();
                chatBox.innerHTML += `<div class="message ai">IA : ${data.message}</div>`;
                chatBox.scrollTop = chatBox.scrollHeight;
            } catch (error) {
                console.error('Erreur:', error);
                chatBox.innerHTML += `<div class="message ai">IA : Erreur de connexion</div>`;
            }
        }

        document.getElementById('message-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage();
        });
    </script>
@endsection