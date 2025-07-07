<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function lookup(Request $request)
    {
        $query = $request->get('q');

        $response = Http::get("https://api.pdok.nl/bzk/locatieserver/search/v3_1/free", [
            'q' => $query,
        ]);

        return response()->json($response->json());
    }
}
