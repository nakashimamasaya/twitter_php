<?php
use Migrations\AbstractSeed;

class FollowingSeed extends AbstractSeed
{
    public function run()
    {
        $data = [];
        $faker = Faker\Factory::create('ja_JP');

        for ($i = 1; $i <= 100; $i++) {
            for ($j = 1; $j <= 100; $j++) {
                if($i == $j) continue;
                $data[] = [
                    'user_id' => $i,
                    'follower_id' => $j,
                ];
            }
        }

        $table = $this->table('following');
        $table->insert($data)->save();
    }
}
