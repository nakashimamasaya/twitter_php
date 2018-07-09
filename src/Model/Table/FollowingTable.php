<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Following Model
 *
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\BelongsTo $Users
 * @property \App\Model\Table\FollowersTable|\Cake\ORM\Association\BelongsTo $Followers
 *
 * @method \App\Model\Entity\Following get($primaryKey, $options = [])
 * @method \App\Model\Entity\Following newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Following[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Following|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Following|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Following patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Following[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Following findOrCreate($search, callable $callback = null, $options = [])
 */
class FollowingTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('following');
        $this->setDisplayField('user_id');
        $this->setPrimaryKey(['user_id', 'follower_id']);

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'follower_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['follower_id'], 'Users'));

        return $rules;
    }

    public function followUsers(int $user_id = null){
        if(is_null($user_id)) return false;
        $results = $this->find()->where(['user_id = ' => $user_id]);
        $array = [];
        foreach($results as $result){
            array_push($array, $result['follower_id']);
        }
        return $array;
    }

    public function followerUsers(int $user_id = null){
        if(is_null($user_id)) return false;
        $results = $this->find()->where(['follower_id = ' => $user_id])->to_Array();
        $array = [];
        foreach($results as $result){
            array_push($array, $result['user_id']);
        }
        return $array;
    }
}
