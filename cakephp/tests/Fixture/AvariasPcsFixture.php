<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AvariasPcsFixture
 */
class AvariasPcsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'pc_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'avaria_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'id_pc' => ['type' => 'index', 'columns' => ['pc_id'], 'length' => []],
            'id_avaria' => ['type' => 'index', 'columns' => ['avaria_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'id' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
            'avarias_pcs_ibfk_1' => ['type' => 'foreign', 'columns' => ['pc_id'], 'references' => ['pcs', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'avarias_pcs_ibfk_2' => ['type' => 'foreign', 'columns' => ['avaria_id'], 'references' => ['avarias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'pc_id' => 1,
                'avaria_id' => 1,
                'created' => '2020-01-17 11:18:50',
            ],
        ];
        parent::init();
    }
}
