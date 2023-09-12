<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{

    private $roles = array (
        0 =>
        array (
            'name' => 'admin',
            'display_name' => 'Admin User',
            'created_at' => '2017-11-21 16:23:22',
            'updated_at' => '2017-11-21 16:23:22',
        ),
        1 =>
        array (
            'name' => 'trial',
            'display_name' => 'Free Trial',
            'created_at' => '2017-11-21 16:23:22',
            'updated_at' => '2017-11-21 16:23:22',
        ),
        2 =>
        array (
            'name' => 'basic',
            'display_name' => 'Basic Plan',
            'created_at' => '2018-07-03 05:03:21',
            'updated_at' => '2018-07-03 17:28:44',
        ),
        3 =>
        array (
            'name' => 'pro',
            'display_name' => 'Pro Plan',
            'created_at' => '2018-07-03 16:27:16',
            'updated_at' => '2018-07-03 17:28:38',
        ),
        4 =>
        array (
            'name' => 'premium',
            'display_name' => 'Premium Plan',
            'created_at' => '2018-07-03 16:28:42',
            'updated_at' => '2018-07-03 17:28:32',
        ),
        5 =>
        array (
            'name' => 'cancelled',
            'display_name' => 'Cancelled User',
            'created_at' => '2018-07-03 16:28:42',
            'updated_at' => '2018-07-03 17:28:32',
        ),
    );

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        foreach($this->roles as $role) {
            Role::updateOrInsert(
                ['name' => $role['name']],
                [
                    'display_name' => $role['display_name'],
                    'created_at' => $role['created_at'],
                    'updated_at' => $role['updated_at'],
                ]
            );
        }
    }
}
