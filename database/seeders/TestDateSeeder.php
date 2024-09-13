<?php

namespace Database\Seeders;

use App\Models\Information;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Candidate;

class TestDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(200)->create();

        $hold = User::noInfoIds();
        foreach ($hold as $id) {
            Information::factory()->state(['user_id' => $id])->create();
        }

        $employers = User::getEmployersIds();
        foreach ($employers as $key => $id) {
            $user            = User::find($id);
            $user->agency_id = 2;
            $user->save();
        }

        $affiliate = User::getAffiliateIds();
        foreach ($affiliate as $key => $id) {
            $user            = User::find($id);
            $user->agency_id = 2;
            $user->save();
        }

        Candidate::factory(800)->create();
    }
}
