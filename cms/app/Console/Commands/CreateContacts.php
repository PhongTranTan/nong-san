<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contact;
use Illuminate\Support\Str;

class CreateContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_contacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Contacts ';

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
        $number = 0;
        $name = [
            'Phong',
            'Lượng',
            'Vinh',
            'Hưng',
            'Tính',
            'Trinh',
            'Kiều',
            'Phụng',
            'Loan',
            'Loan'
        ];
        $full = [
            'Trần Văn',
            'Nguyễn Thị',
            'Đõ Tấn',
            'Kim Ngọc',
            'Bùi Thị',
            'Đào Văn',
            'Kiều Bích',
            'Đoàn Phụng',
            'Văn Loan',
            'Văn Loan'
        ];
        for ($i = 1; $i < 20; $i++) {
            $keyName = rand(1,10);
            $keyFull = rand(1,10);
            $fullName = "Test";
            $input = [
                'name' => $fullName,
                'phone' => '1234567890',
                'email' => 'test@gmail.com',
                'message' => 'Cần sự hổ trợ gấp',
                'subject' => 'Cần sự hổ trợ gấp'
            ];
            Contact::create($input);
            $number++;
        }
        $this->info("Create {$number} done !");
    }
}
