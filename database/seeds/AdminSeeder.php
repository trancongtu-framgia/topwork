<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
        	$role->name = 'admin';
        	$role->save();

        	$user = new \App\User();
        	$user->email = 'admin@admin.com';
        	$user->password = Hash::make('admin@123');
        	$user->user_name = 'admin@admin.com';
        	$user->status = 1;
        	$user->role_id = $role->id;
        	$user->token = Uuid::generate()->string;
        	$user->save();

        	$admin = new \App\Models\Admin();
        	$admin->user_id = $user->id;
        	$admin->name = 'Admin';
        	$admin->save();

        	DB::commit();
		} catch (Exception $e) {
        	DB::rollBack();

        	return $e;
		}
    }
}
