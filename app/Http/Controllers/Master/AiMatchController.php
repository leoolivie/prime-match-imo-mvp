<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Services\OpenAiPropertyMatchService;
use Illuminate\Http\Request;
use RuntimeException;

class AiMatchController extends Controller
{
    public function __construct(private OpenAiPropertyMatchService $matchService)
    {
    }

    public function index(Request $request)
    {
        $minPrice = $request->integer('min_price', 1000000);

        $result = [
            'investors' => collect(),
            'properties' => collect(),
            'raw_response' => null,
            'matches' => [],
        ];

        $error = null;

        try {
            $result = $this->matchService->generateRecommendations($minPrice);
        } catch (RuntimeException $exception) {
            $error = $exception->getMessage();
        }

        return view('master.ai.recommendations', [
            'minPrice' => $minPrice,
            'investors' => $result['investors'],
            'properties' => $result['properties'],
            'rawResponse' => $result['raw_response'],
            'matches' => $result['matches'],
            'error' => $error,
        ]);
    }
}
