<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TilledService
{
    // Define a class property for Tilled account ID
    protected $tilledAccountId;

    // Define a constructor that accepts a Tilled account ID parameter
    public function __construct($tilledAccountId)
    {
        $this->tilledAccountId = $tilledAccountId;
    }

    // Method to retrieve the required variables
    public function getTilledVariables()
    {
        // Retrieve the Tilled Secret API Key and base URL from config
        $tilledSecretApiKey = config('app.tilled.secret_api_key');
        $tilledBaseUrl = config('app.tilled.base_url');

        // Return the retrieved values
        return [
            'tilledSecretApiKey' => $tilledSecretApiKey,
            'tilledBaseUrl' => $tilledBaseUrl,
        ];
    }
}
