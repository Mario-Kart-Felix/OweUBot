<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetWebhook extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:setwebhook';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Specify a url and receive incoming updates via an outgoing webhook';
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
      try {
        $response = \Telegram::setWebhook(['url' => env('APP_URL').'/'.config('telegram.bot_token').'/webhook']);
        $this->info('Processati ' . count($result) . ' messaggi.');
      } catch (\Exception $e) {
        $this->error('Error: ' . $e->getMessage());
      }
    }
}
