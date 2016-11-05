<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\DeliveryRequest;
use App\Subscription;
use App\Menu;
use App\User;
use App\Notifications\SubscriptionMade;
use Illuminate\Support\Facades\Notification;

class SubscriptionController extends Controller
{
    protected $mainMenu;

    public function __construct(){
        $this->mainMenu = Menu::getPublishedMenuItems();
    }

    public function store(SubscriptionRequest $request){

        $subscription = new Subscription($request->all());
        $subscription->save();

        //Notify admin about form subscription
        $emails[] = User::find(User::$rootId);
        Notification::send($emails, new SubscriptionMade());


        if($request->callback){
            $this->sendFakeCallback($request->email);
        }

        return redirect()->back()->with('message', 'Thank you for your subscription');
    }

    public function remove(Subscription $subscription){

        $subscription->delete();
        return redirect()->back()->with('message', 'Success');
    }

    public function adminIndex(){

        return view('subscription.admin_index',[
            'subscriptions' => Subscription::all(),
            'mainMenu' => $this->mainMenu,
        ]);
    }

    public function delivery(DeliveryRequest $request){
        $emails = Subscription::getSubscribedMails();
        if(count($emails)){
            foreach($emails as $email) {
                $this->sendMessage($email->email, $request->message);
            }
            return redirect()->back()->with('message', 'You spammed them');
        }

        return redirect()->back()->withErrors(['There is no subscribers']);
    }

    /**
     * Imitation of reaction of checked callback option of subscription form
     */
    private function sendMessage($to, $text){
        $rootUser = User::find(User::$rootId);
        \Mail::raw($text, function($message) use ($to, $rootUser, $text)
        {
            $message->from($rootUser->email, 'Redwerk test');
            $message->to($to)->subject('Mass delivery from Redwerk test');
        });
    }

    /**
     * Imitation of reaction of checked callback option of subscription form
     */
    private function sendFakeCallback($to){
        $rootUser = User::find(User::$rootId);

        \Mail::raw('Fake callback from Redwerk test task', function($message) use ($to, $rootUser)
        {
            $message->from($rootUser->email, 'Redwerk test');
            $message->to($to)->subject('Fake callback from Redwerk test task!');
        });
    }
}
