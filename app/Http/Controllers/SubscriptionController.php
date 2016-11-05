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

    /**
     * Storing new subscription to DB
     * notifying admin via email that form was subscribed
     * If users checked callback - we send him email to imitate callback
     */
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
        ]);
    }

    /**
     * Callback for mass delivery form - we sending emails for all who subscribed our form
     * and set subscription to TRUE
     */
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
     * Send mass emails
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
