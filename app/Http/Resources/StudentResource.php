<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'full_name' => "{$this->lastname} {$this->firstname}",
            'full_name_kana' => "{$this->lastname_kana} {$this->firstname_kana}",
            'student_photo_path' => $this->student_photo_path,
            'membership_status' => $this->membership_status,
            'is_temporary' => $this->is_temporary,
        ];
    }
}
