<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FollowingTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FollowingTable Test Case
 */
class FollowingTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FollowingTable
     */
    public $Following;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.following',
        'app.users',
        'app.followers'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Following') ? [] : ['className' => FollowingTable::class];
        $this->Following = TableRegistry::getTableLocator()->get('Following', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Following);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
