<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AvariasPc Entity
 *
 * @property int $id
 * @property int|null $pc_id
 * @property int|null $avaria_id
 * @property \Cake\I18n\FrozenTime|null $created
 *
 * @property \App\Model\Entity\Pc $pc
 * @property \App\Model\Entity\Avaria $avaria
 */
class AvariasPc extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'pc_id' => true,
        'avaria_id' => true,
        'created' => true,
        'pc' => true,
        'avaria' => true,
    ];
}
