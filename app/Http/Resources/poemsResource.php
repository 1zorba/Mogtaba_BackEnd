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
            'poem_title' => $this->title,
            'poem_content' => $this->content,
            'image' => $this->image,
            'poem_link' => $this->poem_link,


        ];
    }
}
