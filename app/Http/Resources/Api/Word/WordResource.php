<?php

namespace App\Http\Resources\Api\Word;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * WordResource
 */
class WordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
        ];
    }
}
