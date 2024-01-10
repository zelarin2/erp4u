<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class CocktailController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
        $response = Http::get("https://www.thecocktaildb.com/api/json/v2/9973533/popular.php");
        $response = json_decode($response->body(), true);
        $ingredients = [];
        $drinks = [];
        $drinks  = $response['drinks'];


        if ($response !== null) {
            
            for ($i = 1; $i <= 20; $i++) {
                $drink = $drinks[$i];
                $strDrink = $drink['strDrink'];
                $strInstructions = $drink['strInstructions'];
                for ($i = 1; $i <= 15; $i++) {    
                    $ingredient = $drink['strIngredient' . $i];
                    $measurements = $drink['strMeasure' . $i];

                    if (
                        $ingredient !== null &&
                        $measurements !== null
                    ) {
                        $ingredients[] = [
                            'ingredient' => $ingredient,
                            'measurements' => $measurements
                        ];
                    }
                }
                $drink[] = [
                    'ingredients' => $ingredients,
                    'strDrink' => $strDrink,
                    'strInstructions' => $strInstructions,
                ];
            }

        if ($response['drinks'] !== null) {
            return view('backend.cocktails_index', [
                'user' => $user,
                'drink' => $drink,
                'ingredients' => $ingredients,
                'response' => $response,
            ]);
        }
    }
        return redirect('/cocktails_index');
    }
}
