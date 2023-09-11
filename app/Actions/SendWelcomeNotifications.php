<?php
namespace App\Actions;

use Closure;
use App\Notifications\WelcomeNotification;

Class SendWelcomeNotifications
{


      public function handle($payload,Closure $next)
      {
           $subscriber=$payload['subscriber'];
           $subscriber->notify(new WelcomeNotification);
           
           return $next($payload);
      }

}