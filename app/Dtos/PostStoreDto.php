<?php

namespace App\Dtos;

use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

class PostStoreDto extends DataTransferObject
{
    public string $title;
    public string $body;
    public int $user_id;
}
