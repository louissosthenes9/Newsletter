<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Actions\BindToTopic;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use App\Actions\SubscriptionProcess;

class StoreController extends Controller
{
    public function __construct(
        private readonly SubscriptionProcess $process,
    ) {}


    public function __invoke(Request $request){
      //  $this->process->run($request->payload());
       $subscriber = Subscriber::create(
        ['email'=>$request->email]
       );

       $topicId = $request->input('topic_id');
       $payload =[
        'subscriber'=>$subscriber,
          'topicId'=>$topicId
          
          ];
          
       $pipes = [
           BindToTopic::class,
           SendWelcomeNotification::class,
        ];
        
        app(Pipeline::class)->send($payload)
                            ->through($pipes)
                            ->thenReturn();

}    
       
}


