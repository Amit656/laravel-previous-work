<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public $url;

    public function __construct()
    {
        $this->url = config('services.authservice.url');
    }

      public function doLogin(Request $login)
      {
        dd($token);
          try {
            $token = $login->bearerToken();
            print_r($token);
          } catch (\Throwable $th) {
              logger($th);
          }

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post($this->url.'account/authorize', [
                'client_id' => 'string',
                'response_type' => 'string',
                'authorization_code' => $login->authorization_code,
                'client_secret' => 'string',
                'redirect_uri' => 'string',
            ]);

          if ($response->successful()) {
              print_r($response->json());
          }
      }
}
