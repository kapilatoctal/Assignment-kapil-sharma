<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Pool;
use App\Http\Controllers\Controller;
use App\Http\Resources\ApiResponseResource;
use App\Http\Resources\ApiResponseResourceCollection;
use Illuminate\Support\Facades\Http;

class ExternalController extends Controller
{


    public function MergedApi()
    {
        try {
            // $response1 = Http::acceptJson()->get('https://restcountries.com/v3.1/lang/Hindi');
            // $response2 = Http::acceptJson()->get('https://restcountries.com/v3.1/name/india');

            /**
             *  getting request from both API with concurrent requests with help of pool
             */
            $responses = Http::pool(fn (Pool $pool) => [
                $pool->as('lang')->acceptJson()->get(config('app.api_data.lang')),
                $pool->as('country')->acceptJson()->get(config('app.api_data.country')),
            ]);


            if ($responses['lang']->successful() && $responses['country']->successful()) {

               /**
                *  merging both API's data into one variable to pass in custom api resource
                */

                foreach ($responses as $key => $value) {
                    $data[$key] = new ApiResponseResourceCollection($responses[$key]->json());
                }

                /**
                 *  return data to api resource with statis mathod make of resource class
                 */
                return response()->json($data);
            } else {
                return response()->json(['error' => 'Failed to fetch data from APIs'], 500);
            }
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],500);
        }
    }
}
