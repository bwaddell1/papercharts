<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtiesTableSeeder extends Seeder
{
    
    private $specialties = [
        [
            "name" => "Pediatrics",
            "code" => "pediatrics",
            "bg_color" => "#faedcc",
            "color" => "#3d2d1e",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Cardiovascular",
            "code" => "cardiovascular",
            "bg_color" => "#f1e1e9",
            "color" => "#492738",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Family Medicine",
            "code" => "family_medicine",
            "bg_color" => "#f5dfcc",
            "color" => "#452a13",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Dermatology",
            "code" => "dermatology",
            "bg_color" => "#f1f0f0",
            "color" => "#32302c",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Endocrinology",
            "code" => "endocrinology",
            "bg_color" => "#e6deed",
            "color" => "#3d2551",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Nephrology",
            "code" => "nephrology",
            "bg_color" => "#e3e2e0",
            "color" => "#32302c",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Orthopedics",
            "code" => "orthopedics",
            "bg_color" => "#deecdc",
            "color" => "#23372a",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Pythsical Therapy",
            "code" => "pythsical_therapy",
            "bg_color" => "#ece0db",
            "color" => "#453025",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Gastroenterology",
            "code" => "gastroenterology",
            "bg_color" => "#d6e4ee",
            "color" => "#1f3245",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
        [
            "name" => "Opthalmology",
            "code" => "opthalmology",
            "bg_color" => "#fae3de",
            "color" => "#551c18",
            "created_at" => "2023-09-12 16:23:22",
            "updated_at" => "2023-09-12 16:23:22",
        ],
    ];

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        foreach($this->specialties as $specialty) {
            Specialty::updateOrInsert(
                ['code' => $specialty['code']],
                [
                    'name' => $specialty['name'],
                    'bg_color' => $specialty['bg_color'],
                    'color' => $specialty['color'],
                    'created_at' => $specialty['created_at'],
                    'updated_at' => $specialty['updated_at'],
                ]
            );
        }
    }
}
