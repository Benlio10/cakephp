<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pcs Model
 *
 * @property \App\Model\Table\AvariasTable&\Cake\ORM\Association\BelongsToMany $Avarias
 *
 * @method \App\Model\Entity\Pc get($primaryKey, $options = [])
 * @method \App\Model\Entity\Pc newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Pc[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Pc|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pc saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Pc patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Pc[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Pc findOrCreate($search, callable $callback = null, $options = [])
 */
class PcsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('pcs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsToMany('Avarias', [
            'foreignKey' => 'pc_id',
            'targetForeignKey' => 'avaria_id',
            'joinTable' => 'avarias_pcs',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->allowEmptyString('name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['id']));

        return $rules;
    }
}
