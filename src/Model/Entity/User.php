<?php
namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property bool $private
 */
class User extends Entity
{

    protected $_accessible = [
        'name' => true,
        'username' => true,
        'email' => true,
        'password' => true,
        'private' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($password){
      if (strlen($password) > 0) {
          return (new DefaultPasswordHasher)->hash($password);
        }
    }
}
