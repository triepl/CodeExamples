<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\OrdersItemsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\OrdersItemsTable Test Case
 */
class OrdersItemsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\OrdersItemsTable
     */
    public $OrdersItems;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.orders_items',
        'app.orders',
        'app.users',
        'app.books',
        'app.publishers',
        'app.raitings',
        'app.tags',
        'app.books_tags'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('OrdersItems') ? [] : ['className' => 'App\Model\Table\OrdersItemsTable'];
        $this->OrdersItems = TableRegistry::get('OrdersItems', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->OrdersItems);

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
