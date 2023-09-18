<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    protected $users = array(
        0 => array(
            'id' => 1,
            'role_id' => 1,
            'name' => 'Wave Admin',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'avatar' => 'users/default.png',
            'password' => '$2y$10$L8MjmjVVOCbyLHbp7pq/9.1ZEEa5AqE67ZXLd2M4.res05a3Rz/G2',
            'remember_token' => '4oXDVo48Lm1pc4j7NkWI9cMO4hv5OIEJFMrqjSCKQsIwWMGRFYDvNpdioBfo',
            'settings' => null,
            'created_at' => '2017-11-21 16:07:22',
            'updated_at' => '2018-09-22 23:34:02',
            'stripe_id' => null,
            'card_brand' => null,
            'card_last_four' => null,
            'trial_ends_at' => null,
            'verification_code' => null,
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
        foreach ($this->users as $user) {
            User::updateOrInsert(
                ['email' => $user['email']],
                [
                    'role_id' => $user['role_id'],
                    'name' => $user['name'],
                    'username' => $user['username'],
                    'avatar' => $user['avatar'],
                    'password' => $user['password'],
                    'remember_token' => $user['remember_token'],
                    'settings' => $user['settings'],
                    'password' => $user['password'],
                    'created_at' => $user['created_at'],
                    'stripe_id' => $user['stripe_id'],
                    'card_brand' => $user['card_brand'],
                    'card_last_four' => $user['card_last_four'],
                    'trial_ends_at' => $user['trial_ends_at'],
                    'verification_code' => $user['verification_code'],
                    'verified' => $user['verified'],
                    'updated_at' => $user['updated_at'],
                ]
            );
        }
    }
}
