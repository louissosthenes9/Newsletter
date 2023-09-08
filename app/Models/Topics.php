<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Topics extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',

    ];

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class, 'subscriber_topic');
    }


    
    public function subscribe($subscriberId = null)
    {
        $this->subscriptions()->create([
            'subscriber_id' => $subscriberId ?: auth()->id()
        ]);
        return $this;
    }

    public function subscriptions()
    {
        return $this->hasMany(TopicSubscription::class);
    }

    public function unsubscribe($subscriberId = null)
    {
        $this->subscriptions()
            ->where('subscriber_id', $subscriberId ?: auth()->id())
            ->delete();
    }
}
