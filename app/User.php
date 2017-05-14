<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'telegram_id', 'first_name', 'last_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Store the fields in a new record.
     *
     * @param array
     */
    public function store($fields) {
        // Validate the request...
        $user = new User;
        // Store fields
        $user->telegram_id = $fields["telegram_id"];
        $user->first_name = $fields["first_name"];
        $user->last_name = $fields["last_name"];
        // Save record
        $user->save();
    }

    /**
     * Check if user already exist.
     *
     * @param string
     */
    public function userExist($telegram_id) {
        // Validate the request...
        $result = $this::where('telegram_id', $telegram_id)->count();
        if($result === 0){
          return false;
        }
        return true;
    }
}
