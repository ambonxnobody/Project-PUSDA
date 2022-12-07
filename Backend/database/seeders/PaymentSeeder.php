<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            [
                'childrens_id' => 3,
                'year' => '2022',
                'payment_amount' => 4000000,
                'proof_of_payment' => null,
            ],
            [
                'childrens_id' => 3,
                'year' => '2023',
                'payment_amount' => 3000000,
                'proof_of_payment' => null,
            ],
            [
                'childrens_id' => 4,
                'year' => '2022',
                'payment_amount' => 6000000,
                'proof_of_payment' => null,
            ],
            [
                'childrens_id' => 4,
                'year' => '2023',
                'payment_amount' => 5000000,
                'proof_of_payment' => null,
            ],

        ];

        DB::table('payments')->insert($payments);
    }
}
