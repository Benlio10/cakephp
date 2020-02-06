<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ArquivosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ArquivosTable Test Case
 */
class ArquivosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ArquivosTable
     */
    public $Arquivos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Arquivos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Arquivos') ? [] : ['className' => ArquivosTable::class];
        $this->Arquivos = TableRegistry::getTableLocator()->get('Arquivos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Arquivos);

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
}
