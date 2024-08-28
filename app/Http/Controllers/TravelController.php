<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Http;

class TravelController extends Controller {
    public function index() {
        $cities = City::all(); // Obtén la lista de ciudades de la base de datos
        return view('index', compact('cities'));
    }

    public function calculate(Request $request) {
        $city = City::find($request->city);
        // Obtener el clima
        $temperature = $this->getWeather($city->name);
        // Obtener la tasa de cambio de COP a la moneda local
        $exchangeRate = $this->getExchangeRate('COP', $city->currency);
        $budgetInLocalCurrency = $request->budget * $exchangeRate;

        return response()->json([
            'temperature' => $temperature,
            'currency_name' => $city->currency,
            'currency_symbol' => $city->currency_symbol,
            'budget_in_local_currency' => number_format($budgetInLocalCurrency, 2),
            'exchange_rate' => $exchangeRate,
        ]);
    }

    private function getWeather($city) {
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            'X-RapidAPI-Host' => 'weatherapi-com.p.rapidapi.com'
        ])->withOptions([
            'verify' => false, // Desactiva la verificación SSL
        ])->get('https://weatherapi-com.p.rapidapi.com/current.json', [
            'q' => $city
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['current']['temp_c'] ?? 'N/A';
        } else {
            return null;
        }
    }

    private function getExchangeRate($fromCurrency, $toCurrency) {
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('RAPIDAPI_KEY'),
            'X-RapidAPI-Host' => 'exchangerate-api.p.rapidapi.com'
        ])->withOptions([
                'verify' => false, // Desactiva la verificación SSL
        ])->get('https://exchangerate-api.p.rapidapi.com/rapid/latest/'.$fromCurrency);

        if ($response->successful()) {
            $data = $response->json();
            return $data['rates'][$toCurrency] ?? null;
        } else {
            return null;
        }
    }
}
