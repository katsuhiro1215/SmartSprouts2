<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Student;
use App\Models\StudentUser;
use App\Models\StudentEnrollment;
use App\Models\Guardian;
use App\Models\GuardianUser;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(AdminProfileSeeder::class);
        $this->call(OrganizationSeeder::class);
        $this->call(SystemSettingSeeder::class);
        $this->call(StoreSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(CourseCategorySeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(UserSeeder::class);
        User::factory(200)->create();
        UserAddress::factory(200)->create();
        Student::factory(200)->create();
        StudentUser::factory(200)->create();
        StudentEnrollment::factory(200)->create();
        Guardian::factory(400)->create();
        GuardianUser::factory(400)->create();
        $this->call(SchoolSeeder::class);
        $this->call(StoreUserSeeder::class);
    }
}
