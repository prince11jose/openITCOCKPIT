<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customvariable Entity
 *
 * @property int $id
 * @property int $object_id
 * @property int $objecttype_id
 * @property string $name
 * @property string $value
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Object $object
 */
class Customvariable extends Entity {

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
        'object_id'     => true,
        'objecttype_id' => true,
        'name'          => true,
        'value'         => true,
        'created'       => true,
        'modified'      => true,
        'object'        => true,
        'objecttype'    => true
    ];
}
