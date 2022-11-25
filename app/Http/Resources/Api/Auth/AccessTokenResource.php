<?php
/**
 * Copyright © 2020 GBKSOFT. Web and Mobile Software Development.
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class AccessTokenResource extends JsonResource
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
            'token' => $this->accessToken,
            'expiredAt' => $this->token['expires_at']->unix()
        ];
    }
}
