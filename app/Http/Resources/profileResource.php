<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profileResource extends JsonResource
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
            'job_title' => $this->job_title,
            'bio' => $this->bio,
            'profile_image' => $this->profile_image,
            'cv_url' => $this->cv_url,
            'social_links' => $this->social_links,
            'phone' => $this->phone,
            'borrow' => $this->borrow,
            'social_links2' => $this->social_links2,

        ];
    }
}
