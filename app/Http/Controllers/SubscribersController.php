<?php

namespace App\Http\Controllers;

use Validator;
use App\Subscriber;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::all();
        return $subscribers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $url = $request->input('url');


        $validator = Validator::make($request->all(), [
            'url' => 'required|unique:subscribers|url'
        ]);

        $errors = $validator->errors();

        if ($errors->any()){
            return $errors;
        }

        $subscriber = Subscriber::create(compact('url'));
        $eventIds = $request->input('eventIds');
        $subscriber->events()->attach($eventIds);

        return "Subscriber Succesfully added";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriber $subscriber)
    {
        return $subscriber;
    }
}
