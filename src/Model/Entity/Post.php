<?php
namespace Posts\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity.
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $intro
 * @property string $status
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property \Posts\Model\Entity\Phinxlog[] $phinxlog
 */
class Post extends Entity
{
    const STATUS_DRAFT= 0;
    const STATUS_WAITING_FOR_APPROVAL = 1;
    const STATUS_PUBLISHED = 2;

    /**
     * The main method for any enumeration, should be called statically
     * Now also supports reordering/filtering
     *
     * @link http://www.dereuromark.de/2010/06/24/static-enums-or-semihardcoded-attributes/
     * @param string $value or array $keys or NULL for complete array result
     * @return mixed string/array
     */
    public static function statuses($value = null)
    {
        $options = [
            self::STATUS_DRAFT => 'draft',
            self::STATUS_WAITING_FOR_APPROVAL => 'waiting for approval',
            self::STATUS_PUBLISHED => 'approved',
        ];
        return self::enum($value, $options);
    }

    /**
     * The main method for any enumeration, should be called statically
     * Now also supports reordering/filtering
     *
     * @link http://www.dereuromark.de/2010/06/24/static-enums-or-semihardcoded-attributes/
     * @param string $value or array $keys or NULL for complete array result
     * @param array $options (actual data)
     * @return mixed string/array
     */
    public static function enum($value, array $options, $default = null)
    {
        if ($value !== null && !is_array($value)) {
            if (array_key_exists($value, $options)) {
                return $options[$value];
            }
            return $default;
        }
        if ($value !== null) {
            $newOptions = [];
            foreach ($value as $v) {
                $newOptions[$v] = $options[$v];
            }
            return $newOptions;
        }
        return $options;
    }
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
        'id' => false,
    ];
}
