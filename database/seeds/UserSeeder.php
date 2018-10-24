<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $role = new \App\Models\Role();
            $role->name = 'company';
            $role->save();

            $user = new \App\User();
            $user->email = 'company@company.com';
            $user->name = 'Framgia';
            $user->password = Hash::make('company@123');
            $user->user_name = 'company@company.com';
            $user->status = 1;
            $user->role_id = $role->id;
            $user->token = Uuid::generate()->string;
            $user->save();

            $company = new \App\Models\Company();
            $company->user_id = $user->id;
            $company->address = '13F Keangnam Landmark 72 Tower, Plot E6, Pham Hung Road, Nam Tu Liem District., Ha Noi';
            $company->country = 'Japan';
            $company->working_day = 'Thu 2 - Thu 6';
            $company->description = 'chua co gi';
            $company->logo_url = 'framgia.png';
            $company->range = '301 - 1000';
            $company->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return $e;
        }
    }
}
