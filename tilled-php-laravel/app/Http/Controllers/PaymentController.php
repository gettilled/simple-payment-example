<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Client\RequestException;
use App\Services\TilledService; // Import the TilledService class

class PaymentController extends Controller
{
    public function createPaymentIntent(Request $request, $id): JsonResponse
    {
        try {
            // Create an instance of TilledService by passing the account ID
            $tilledService = new TilledService($id);
            // Call the getTilledVariables method to retrieve the required variables
            $tilledVariables = $tilledService->getTilledVariables();

            // Retrieve the required values from the returned variables
            $tilledSecretApiKey = $tilledVariables['tilledSecretApiKey'];
            $baseUrl = $tilledVariables['tilledBaseUrl'];
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $tilledSecretApiKey,
                'Tilled-Account' => $id,
            ];

            // Make the API request using a timeout to handle any potential delays
            $response = Http::withHeaders($headers)->timeout(10)->post($baseUrl . '/v1/payment-intents', [
                'amount' => 500,
                'currency' => 'usd',
                'payment_method_types' => ['card', 'ach_debit'],
            ]);
            // Check if the API request was successful
            if ($response->successful()) {
                $data = $response->json();
                // Return the client secret from the response data as a JSON response
                return response()->json(['client_secret' => $data['client_secret']]);
            }
            // If the request was not successful, handle errors appropriately
            $errorMsg = 'Server error. Please try again later.';
            $statusCode = $response->clientError() ? 400 : 500;
            // Check if the request was a client error
            if ($response->clientError()) {
                $errorData = $response->json();
                $errorMsg = $errorData['message'] ?? $errorMsg;
            }
            // Return the error message and status code as a JSON response
            return response()->json(['message' => $errorMsg], $statusCode);
        } catch (RequestException $exception) {
            return response()->json(['message' => 'Unable to process the request. Please try again later.'], 500);
        }
    }
}