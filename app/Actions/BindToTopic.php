<?php 

namespace App\Actions;
use Closure;

class BindToTopic{

    public function handle($payload,Closure $next)
    {
        $subscriber=$payload['subscriber'];
        $subscriber->topics()->attach($payload['topicId']);


        return $next($payload);
    }
}


  


