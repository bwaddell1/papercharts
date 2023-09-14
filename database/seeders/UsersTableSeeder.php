<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{

    protected $users = array (
        0 => 
        array (
            'id' => 1,
            'role_id' => 1,
            'name' => 'Wave Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'avatar' => 'users/default.png',
            'password' => '$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2',
            'remember_token' => '4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',
            'settings' => NULL,
            'created_at' => '2017-11-21 16:07:22',
            'updated_at' => '2018-09-22 23:34:02',
            'stripe_id' => NULL,
            'card_brand' => NULL,
            'card_last_four' => NULL,
            'trial_ends_at' => NULL,
            'verification_code' => NULL,
            'verified' => 1,
        ),
    );

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        foreach($this->users as $user) {
            User::updateOrInsert(
                ['email' => $user['email']],
                [
                    'role_id' => $specialty['role_id'],
                    'name' => $specialty['name'],
                    'username' => $specialty['username'],
                    'avatar' => $specialty['avatar'],
                    'password' => $specialty['password'],
                    'remember_token' => $specialty['remember_token'],
                    'settings' => $specialty['settings'],
                    'password' => $specialty['password'],
                    'created_at' => $specialty['created_at'],
                    'stripe_id' => $specialty['stripe_id'],
                    'card_brand' => $specialty['card_brand'],
                    'card_last_four' => $specialty['card_last_four'],
                    'trial_ends_at' => $specialty['trial_ends_at'],
                    'verification_code' => $specialty['verification_code'],
                    'verified' => $specialty['verified'],
                    'updated_at' => $specialty['updated_at'],
                ]
            );
        }
    }
}