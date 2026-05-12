<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->format('Y-m-d'), // حروف صغيرة للتاريخ الرقمي            'profile' => new profileResource($this->whenLoaded('profile')),
            'projects' => projectsResource::collection($this->whenLoaded('projects')),
            'services' => servicesResource::collection($this->whenLoaded('services')),
            // if we get all  users with profiles
            // 'profile' =>  profileResource::collection($this->whenLoaded('profile')),
        ];
    }
}
