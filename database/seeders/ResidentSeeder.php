<?php
use Illuminate\Database\Seeder;
use App\Models\Resident;

class ResidentSeeder extends Seeder
{
    public function run(): void
    {
        Resident::create([
            'nik' => '1234567890123456',
            'name' => 'Siti Aminah',
            'gender' => 'female',
            'birth_place' => 'Rangkasbitung',
            'birth_date' => '1998-11-22',
            'address' => 'Kp. Cibeureum',
            'religion' => 'Islam',
            'marital_status' => 'married',
            'occupation' => 'Ibu Rumah Tangga',
            'phone' => '089876543210',
            'status' => 'active',
        ]);
    }
}
