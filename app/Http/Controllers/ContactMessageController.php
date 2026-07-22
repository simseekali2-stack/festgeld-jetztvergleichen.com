<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Services\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactMessageController extends Controller
{
    public function __construct(private API $api) {}

    /**
     * Publicly store a new contact message and forward to external API.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'full_name'   => ['required', 'string', 'min:2', 'max:100', 'not_regex:/[<>]/'],
            'email'       => ['required', 'email', 'max:255'],
            'phone'       => ['required', 'string', 'min:5', 'max:20'],
            'message'     => ['required', 'string', 'min:5', 'max:5000', 'not_regex:/[<>]/'],
            'website'     => ['present', 'max:0'], // honeypot — must be empty
            '_timestamp'  => ['nullable', 'integer'],
        ], [
            'required'    => 'Bitte füllen Sie alle Pflichtfelder korrekt aus.',
            'email'       => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'website.max' => 'Ungültige Anfrage.',
            'min'         => 'Dieses Feld ist zu kurz.',
            'max'         => 'Dieses Feld ist zu lang.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        // Forward to external API
        $response = $this->api->post('api/contact', [
            'full_name'   => $validated['full_name'],
            'email'       => $validated['email'],
            'phone'       => $validated['phone'],
            'message'     => $validated['message'],
            'website'     => '',
            '_timestamp'  => $validated['_timestamp'] ?? null,
        ]);

        if (!empty($response['success'])) {
            return response()->json([
                'success' => true,
                'message' => 'Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet.',
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => $response['message'] ?? 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.',
        ], 400);
    }

    /**
     * Admin: Display a listing of messages.
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'data' => $messages
        ]);
    }

    /**
     * Admin: Mark message as read.
     */
    public function markRead(string $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Mesaj okundu olarak işaretlendi.'
        ]);
    }

    /**
     * Admin: Remove a message.
     */
    public function destroy(string $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mesaj başarıyla silindi.'
        ]);
    }
}
