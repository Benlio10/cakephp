<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegistoAvaria Entity
 *
 * @property int $id
 * @property int|null $id_pc
 * @property int|null $id_avaria
 * @property \Cake\I18n\FrozenTime|null $created
 */
class RegistoAvaria extends Entity
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
        'id_pc' => true,
        'id_avaria' => true,
        'created' => true,
    ];
}
