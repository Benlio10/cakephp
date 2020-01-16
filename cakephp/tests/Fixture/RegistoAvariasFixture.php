<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegistoAvariasFixture
 */
class RegistoAvariasFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_pc' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_avaria' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'precision' => null, 'null' => true, 'default' => null, 'comment' => ''],
        '_indexes' => [
            'id_pc' => ['type' => 'index', 'columns' => ['id_pc'], 'length' => []],
            'id_avaria' => ['type' => 'index', 'columns' => ['id_avaria'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'id' => ['type' => 'unique', 'columns' => ['id'], 'length' => []],
            'registo_avarias_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_pc'], 'references' => ['pcs', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'registo_avarias_ibfk_2' => ['type' => 'foreign', 'columns' => ['id_avaria'], 'references' => ['avarias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'id_pc' => 1,
                'id_avaria' => 1,
                'created' => '2020-01-14 10:11:05',
            ],
        ];
        parent::init();
    }
}
