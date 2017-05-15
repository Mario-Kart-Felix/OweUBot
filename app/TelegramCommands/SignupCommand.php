<?php namespace App\TelegramCommands;

use Telegram\Bot\Commands\Command;
use Telegram\Bot\Actions;
use \App\User;

class SignupCommand extends Command
{
    /**
  * @var string Command Name
  */
  protected $name = "signup";

  /**
  * @var string Command Description
  */
  protected $description = "Signup to OweUBot (name, last name and telegram id saved)";

  /**
  * @inheritdoc
  */
  public function handle($arguments) {
    // typing
    $this->replyWithChatAction(['action' => Actions::TYPING]);

    // get message
    $user = $this->getUpdate();

    // are we in a group?
    if($user["message"]["chat"]["type"] === 'group'){

      //get fields
      $fields = array();
      $fields["telegram_user_id"] = $user["message"]["from"]["id"];
      $fields["telegram_group_id"] = $user["message"]["chat"]["id"];
      $fields["first_name"] = $user["message"]["from"]["first_name"];
      $fields["last_name"] = $user["message"]["from"]["last_name"];

      // check if user already exist in the db
      $user = new User;
      if(!$user->userExist($fields)){
        // new record
        $user->store($fields);
        // success message
        $this->replyWithMessage(['text' => 'Signup successfull']);
      } else {
        $this->replyWithMessage(['text' => 'You are already signup']);
      }

    } else {
      $this->replyWithMessage(['text' => 'OweUBot needs to run in a group to work']);
    }
  }
}
