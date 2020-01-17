<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AvariasPcsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AvariasPcsTable Test Case
 */
class AvariasPcsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AvariasPcsTable
     */
    protected $AvariasPcs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AvariasPcs',
        'app.Pcs',
        'app.Avarias',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('AvariasPcs') ? [] : ['className' => AvariasPcsTable::class];
        $this->AvariasPcs = TableRegistry::getTableLocator()->get('AvariasPcs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AvariasPcs);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
