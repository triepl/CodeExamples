<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RaitingsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RaitingsTable Test Case
 */
class RaitingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RaitingsTable
     */
    public $Raitings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.raitings',
        'app.users',
        'app.books',
        'app.publishers',
        'app.orders_items',
        'app.tags',
        'app.books_tags',
        'app.orders'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Raitings') ? [] : ['className' => 'App\Model\Table\RaitingsTable'];
        $this->Raitings = TableRegistry::get('Raitings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Raitings);

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
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
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
