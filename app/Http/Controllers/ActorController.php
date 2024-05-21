<?php

namespace App\Http\Controllers;

/*
backup API keys:

"X-RapidAPI-Key: 7b10f71653msh1434b7aec2de2c1p1add77jsnaa8d1aba73eb"
"X-RapidAPI-Key: 178c93142fmsh7f5c1328c36edfep1de9e9jsnb158b36f17b6"

*/

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    public function bornInSameDay(Request $request)
    {
       $actorNames = [];
       $month = $request->month;
       $day = $request->day;

        $response1 = Http::withHeaders([
            "X-RapidAPI-Host" => "online-movie-database.p.rapidapi.com",
            "X-RapidAPI-Key" => "178c93142fmsh7f5c1328c36edfep1de9e9jsnb158b36f17b6"
        ])->get("https://online-movie-database.p.rapidapi.com/actors/list-born-today", [
            "month" => $month,
            "day" => $day
        ]);

        $actors = $response1->json();

        $counter = 0;

        foreach ($actors as $actor) {
            if ($counter >= 12) {
                break;
            }

            $actorId = basename(parse_url($actor, PHP_URL_PATH));

            $response2 = Http::withHeaders([
                "X-RapidAPI-Host" => "online-movie-database.p.rapidapi.com",
                "X-RapidAPI-Key" => "6325b644e9msh9488be2337c346dp100c01jsnb11b8c371a37"
            ])->get("https://online-movie-database.p.rapidapi.com/actors/get-bio", [
                "nconst" => $actorId
            ]);

            $actorBio = $response2->json();

            if (!empty($actorBio)) {
                $actorNames[] = $actorBio["name"];
                $counter++;
            }
        }


        echo json_encode($actorNames);
    }

}
