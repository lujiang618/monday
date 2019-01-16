<?php

namespace App\Console\Commands;

use App\Supports\EncryptionHelper;
use Illuminate\Console\Command;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test something';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $crypt = new EncryptionHelper();

        $data = [
            'name' => 'hourse',
            'price' => '107W',
        ];

        $secret = $crypt->encryptToken(json_encode($data));
        echo 'encryption is :'.$secret;

        echo "\n";

        $decode = $crypt->decryptToken($secret);
        echo 'decryption is :'.$decode;
    }
}
