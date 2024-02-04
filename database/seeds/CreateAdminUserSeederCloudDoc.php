<?php

use Illuminate\Database\Seeder;
use App\User,App\Model\Role;
class CreateAdminUserSeederCloudDoc extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Helpers\Helper::connectByDomain('medex');

        $user = User::firstOrCreate(['email'=>'admin@human-ly.com']);
		$user->password = bcrypt('12345678');
		$user->name = 'Human-Ly';
    	if($user->save()){
    		$role = App\Model\Role::where('name','admin')->first();
    		if(!$user->hasRole('admin')){
                $user->roles()->attach($role);
    		}
    	}
    }
}
