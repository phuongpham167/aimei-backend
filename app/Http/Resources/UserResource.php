<?php

namespace App\Http\Resources;


use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var User $user */
        $user = $this->resource;

        return [
            'user_id' => $user->getKey(),
            'name' => $user->name,
            'email' => $user->email,
            'api_token' => $user->api_token
        ];
    }
}
