<?php

namespace App;

class Event extends Model
{
    public function subscribers(){

        return $this -> belongsToMany(Subscriber::class);
    }
}
