<?php
use Migrations\AbstractSeed;

class MessagesSeed extends AbstractSeed
{
    public function run(){
        $data = [];
        $datetime = date('Y-m-d H:i:s');
        $faker = Faker\Factory::create('ja_JP');

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'body' => $faker->text(140),
                'stamp' => $datetime,
                'user_id' => $faker->numberBetween(1, 100),
            ];
        }

        $table = $this->table('messages');
        $table->insert($data)->save();
    }
}
