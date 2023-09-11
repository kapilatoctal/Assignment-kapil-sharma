<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        /**
         * to return all data from collection
         */
        // return [$this->resource];

        /**
         * to return specific keys from collection
         */
        return[
            'name' => $this->resource['name'],
            'independent' =>  $this->resource['independent'],
            'currencies' =>  $this->resource['currencies'],
            'capital' =>  $this->resource['capital'],
        ];

    }
}
