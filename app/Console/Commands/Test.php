<?php

namespace App\Console\Commands;

use App\Supports\crypt\TokenHelper;
use App\Supports\EncryptionHelper;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

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
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $string = '2019';

        $encrypt = encrypt($string);

        echo $encrypt."\n";

        $decrypt = decrypt($encrypt);

        echo $decrypt."\n";

        $encrypt = Crypt::encryptString($string);

        echo $encrypt."\n";

        $decrypt = Crypt::decryptString($encrypt);

        echo $decrypt."\n";
    }
}
