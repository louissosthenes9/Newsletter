<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicSubscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function topic()
    {
        return $this->belongsToMany(Topic::class);
    }
}
