<?php namespace Logingrupa\Studybook\Models;

use Model;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use Kharanenka\Scope\ActiveField;
use Kharanenka\Scope\NameField;
use Kharanenka\Scope\SlugField;
use Kharanenka\Scope\CodeField;
use October\Rain\Database\Traits\NestedTree;
use Lovata\Toolbox\Traits\Helpers\TraitCached;
use RainLab\User\Models\User;

/**
 * Class Transaction
 * @package Logingrupa\Studybook\Models
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
 *
 * @property integer $id
 * @property string $reservation_id
 * @property string $slug
 * @property string $student_id
 * @property string $description
 * @property int $credit
 * @property int $debit
 * @property int $parent_id
 * @property int $nest_left
 * @property int $nest_right
 * @property int $nest_depth
 * @property Transaction $parent
 * @property \October\Rain\Database\Collection|Transaction[] $children
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 * @property \October\Rain\Argon\Argon $payment_at
 *
 * @method static $this children()
 * @method static $this getByParentID(int $iParentID)
 */
class Transaction extends Model
{
    use Sluggable;
    use Validation;
    use ActiveField;
//    use SlugField;
//    use CodeField;
    use NestedTree;
    use TraitCached;

    /** @var string */
    public $table = 'logingrupa_studybook_transactions';
    /** @var array */
    public $implement = [];
    /** @var array */
    public $translatable = [];
    /** @var array */
    public $attributeNames = [
        'slug' => 'lovata.toolbox::lang.field.slug',
    ];
    /** @var array */
    public $rules = [
        'slug' => 'required|unique:logingrupa_studybook_transactions',
    ];
    /** @var array */
    public $slugs = [
        'slug' => 'name'
    ];
    /** @var array */
    public $jsonable = [];
    /** @var array */
    public $fillable = [
        'active',
        'parent_id',
        'type',
        'reservation_id',
        'slug',
        'student_id',
        'credit',
        'debit',
        'note',
        'transaction_at',
    ];
    /** @var array */
    public $cached = [
        'id',
        'active',
        'parent_id',
        'type',
        'reservation_id',
        'slug',
        'student_id',
        'credit',
        'debit',
        'note',
        'transaction_at',
    ];
    /** @var array */
    public $dates = [
        'created_at',
        'updated_at',
//        'transaction_at',
    ];
    /** @var array */
    public $casts = [];
    /** @var array */
    public $visible = [];
    /** @var array */
    public $hidden = [];
    /** @var array */
    public $hasOne = [];
    /** @var array */
    public $hasMany = [];
    /** @var array */
    public $belongsTo = [
        'reservation' => Reservation::class,
        'student' => User::class,
    ];
    /** @var array */
    public $belongsToMany = [];
    /** @var array */
    public $morphTo = [];
    /** @var array */
    public $morphOne = [];
    /** @var array */
    public $morphMany = [];
    /** @var array */
    public $attachOne = [];
    /** @var array */
    public $attachMany = [];

    // Before saving make changes
    public function beforeSave()
    {
        if (empty(post())) {
            return;
        }
        $this->slug = uniqid(false);
        $datetime = explode(' ', $this->transaction_at, 2);
        isset($datetime[0]) ? $this->transaction_at = $datetime[0] : $this->transaction_at = null;
    }
    /**
     * Get by parent ID
     * @param Transaction $obQuery
     * @param string   $sData
     * @return Transaction
     */
    public function scopeGetByParentID($obQuery, $sData)
    {
        return $obQuery->where('parent_id', $sData);
    }
}
