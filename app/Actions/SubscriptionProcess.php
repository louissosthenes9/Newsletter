<?php
namespace App\Actions;
use App\Actions\Process;
use App\Actions\BindToTopic;

final class SubscriptionProcess extends Process
{
    protected array $tasks = [
        
        BindToTopic::class,
        SendWelcomeNotification::class,
    ];
}