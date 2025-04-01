<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIServicesController extends Controller
{
    public function show()
    {
        return view('services.AI.ai-services');
    }

    public function chat(Request $request)
    {
        $userMessage = $request->input('message');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENROUTER_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://openrouter.ai/api/v1/chat/completions', [
            'model' => 'deepseek/deepseek-chat',
            'messages' => [
                ['role' => 'user', 'content' => $userMessage]
            ],
        ]);

        $reply = $response->json()['choices'][0]['message']['content'] ?? 'Erreur de réponse';
        return response()->json(['message' => $reply]);
    }
}