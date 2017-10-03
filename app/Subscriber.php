<?php

namespace App;

class Subscriber extends Model
{
    public function events(){

        return $this -> belongsToMany(Event::class);
    }
}
