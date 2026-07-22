<?php

namespace App\Services;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Exception;

class FormSubmitService
{
    public function __construct(private API $api)
    {
    }

    public function process(array $data, string $ip): array
    {
        // 1. Rate Limiting
        $rateLimitKey = 'form_submit:' . $ip;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 5)) {
            return [
                'status' => 429,
                'data' => [
                    'success' => false,
                    'message' => 'Zu viele Anfragen. Bitte warten Sie einige Minuten, bevor Sie das Formular erneut absenden.'
                ]
            ];
        }

        RateLimiter::hit($rateLimitKey, 600); // 10 Minuten

        // 2. Data Sanitization (Control Char Cleanup)
        $safeData = array_map(function ($value) {
            return is_string($value) ? trim(preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/u', '', $value)) : $value;
        }, $data);

        // 3. Laravel Validation (Gold Standard)
        $validator = Validator::make($safeData, [
            'first_name' => ['required', 'string', 'max:255', 'not_regex:/[<>]/'],
            'last_name' => ['required', 'string', 'max:255', 'not_regex:/[<>]/'],
            'email' => ['required', 'email', 'max:255', 'not_regex:/[<>]/'],
            'phone' => ['required', 'string', 'max:50', 'not_regex:/[<>]/'],
            'bank_id' => ['required', 'string', 'max:255'],
            'credit_option_id' => ['required', 'string', 'max:255'],
            'requested_amount' => ['required', 'numeric', 'min:0'],
            'requested_term' => ['required', 'numeric', 'min:1'],
            'additional_notes' => ['nullable', 'string', 'not_regex:/[<>]/'],
        ], [
            'required' => 'Bitte füllen Sie alle Pflichtfelder aus.',
            'email' => 'Bitte geben Sie eine gültige E-Mail-Adresse ein.',
            'not_regex' => 'Ungültige Formulareingabe. Bitte korrigieren und erneut versuchen.',
            'numeric' => 'Dieser Wert muss eine Zahl sein.',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 422,
                'data' => [
                    'success' => false,
                    // Sadece ilk hata mesajını tekil form mesajı olarak dön
                    'message' => $validator->errors()->first(),
                    'errors' => $validator->errors() // Frontend için Gold tip
                ]
            ];
        }

        $validated = $validator->validated();

        // 4. API Submission Data
        $apiData = [
            'full_name' => trim($validated['first_name'] . ' ' . $validated['last_name']),
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'bank_id' => $validated['bank_id'],
            'credit_option_id' => $validated['credit_option_id'],
            'credit_amount' => $validated['requested_amount'],
            'credit_term' => $validated['requested_term'],
            'additional_notes' => $validated['additional_notes'] ?? ''
        ];

        // 5. Submit to External API
        try {
            $response = $this->api->post('api/form-submit', $apiData);

            if (isset($response['success']) && $response['success']) {
                return [
                    'status' => 200,
                    'data' => [
                        'success' => true,
                        'message' => 'Vielen Dank! Ihre Anfrage wurde erfolgreich gesendet.',
                        'data' => $response
                    ]
                ];
            }

            return [
                'status' => 400,
                'data' => [
                    'success' => false,
                    'message' => $response['message'] ?? 'Ein Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.',
                    'error' => $response
                ]
            ];

        } catch (Exception $e) {
            return [
                'status' => 500,
                'data' => [
                    'success' => false,
                    'message' => 'Ein technischer Fehler ist aufgetreten. Bitte versuchen Sie es später erneut.'
                ]
            ];
        }
    }
}
