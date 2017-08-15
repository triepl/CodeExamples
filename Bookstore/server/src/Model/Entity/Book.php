<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property string $isbn
 * @property string $title
 * @property string $subtitle
 * @property string $abstract
 * @property int $num_pages
 * @property string $author
 * @property float $prize
 * @property string $img
 * @property int $publisher_id
 * @property int $user_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Publisher $publisher
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\OrdersItem[] $orders_items
 * @property \App\Model\Entity\Raiting[] $raitings
 * @property \App\Model\Entity\Tag[] $tags
 */
class Book extends Entity
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
        '*' => true,
        'id' => false
    ];
}
