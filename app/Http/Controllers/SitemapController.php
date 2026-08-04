<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\House;
use Illuminate\Support\Facades\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [
            ['loc' => route('user.home'), 'priority' => '1.0'],
            ['loc' => route('houses.index'), 'priority' => '0.8'],
            ['loc' => route('user.cars.index'), 'priority' => '0.8'],
        ];

        House::approved()->select('id', 'updated_at')->chunk(500, function ($houses) use (&$urls) {
            foreach ($houses as $house) {
                $urls[] = [
                    'loc' => route('houses.show', $house->id),
                    'lastmod' => $house->updated_at?->toAtomString(),
                    'priority' => '0.6',
                ];
            }
        });

        Car::approved()->select('id', 'updated_at')->chunk(500, function ($cars) use (&$urls) {
            foreach ($cars as $car) {
                $urls[] = [
                    'loc' => route('user.cars.show', $car->id),
                    'lastmod' => $car->updated_at?->toAtomString(),
                    'priority' => '0.6',
                ];
            }
        });

        $xml = view('sitemap', compact('urls'))->render();

        return Response::make($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
