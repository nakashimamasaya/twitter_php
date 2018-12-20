<?php
use Migrations\AbstractSeed;
use Cake\Auth\DefaultPasswordHasher;

class UsersSeed extends AbstractSeed
{
    public function run(){
        $data = [];
        $faker = Faker\Factory::create('ja_JP');

        for ($i = 0; $i < 100; $i++) {
            $data[] = [
                'name' => $faker->name,
                'username' => $faker->username,
                'email' => $faker->email,
                'password' => $this->_setPassword(123456),
            ];
        }

        $table = $this->table('users');
        $table->insert($data)->save();
    }

    protected function _setPassword($value){
        return (new DefaultPasswordHasher)->hash($value);
    }
}
