<?php

namespace App\Http\Resources\Api\Dictionary;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * DictionaryResource
 */
class DictionaryResource extends JsonResource
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
