<?php namespace Logingrupa\Studybook\Models;

use Backend\Models\ImportModel;
use Kharanenka\Scope\ActiveField;
use Logingrupa\Studybook\Controllers\Courses;
use Lovata\Toolbox\Traits\Helpers\TraitCached;

/**
 * Class AvailableDate
 * @package Logingrupa\Studybook\Models
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
 *
 * @property integer $id
 * @property bool $active
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 */
class AvailableDate extends ImportModel
{
    use ActiveField;
    use TraitCached;

    /** @var string */
    public $table = 'logingrupa_studybook_availabledates';
    /** @var array */
    public $implement = [
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];
    /** @var array */
    public $translatable = [
            ];
    /** @var array */
    public $attributeNames = [];
    /** @var array */
    public $rules = [];
    /** @var array */
    public $slugs = [];
    /** @var array */
    public $jsonable = [];
    /** @var array */
    public $fillable = [
        'active',
    ];
    /** @var array */
    public $cached = [
        'id',
        'active',
    ];
    /** @var string */
    public $timestamps = false;
    /** @var array */
    public $dates = [
        'datetime',
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
    public $hasMany = [

    ];
    /** @var array */
    public $belongsTo = [];
    /** @var array */
    public $belongsToMany = [
        'courses' => [
            'Logingrupa\Studybook\Models\Course',
            'table' => 'logingrupa_studybook_course_dates',
            'key'      => 'date_id',
            'otherKey' => 'course_id',
        ],
    ];
    /** @var array */
    public $morphTo = [];
    /** @var array */
    public $morphOne = [];
    /** @var array */
    public $morphMany = [];
    /** @var array */
    public $attachOne = [
        'import_file' => [\System\Models\File::class, 'public' => false],
        ];
    /** @var array */
    public $attachMany = [];
    public function listCourses(): array
    {
        return Course::all()->pluck('name', 'id')
            ->toArray();
    }
    /**
     * Parse CSV file
     * @param array $arResults
     * @param null|string $sSessionKey
     */
    public function importData($arResults, $sSessionKey = null)
    {
        if (empty($arResults)) {
            return;
        }

        foreach ($arResults as $sRow => $arData) {
            try {
                $obAvailableDate = new AvailableDate();
                $obAvailableDate->fill($arData);
                $obAvailableDate->save();
                $this->logCreated();
            } catch (\Exception $obException) {
                $this->logError($sRow, $obException->getMessage());
            }
        }
    }
}
