<?php namespace Logingrupa\Studybook\Models;

use Backend\Models\ExportModel;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use Kharanenka\Scope\ActiveField;
use Kharanenka\Scope\NameField;
use Kharanenka\Scope\SlugField;
use Kharanenka\Scope\CodeField;
use Kharanenka\Scope\ExternalIDField;
use Lovata\Toolbox\Traits\Helpers\TraitCached;

/**
 * Class Course
 * @package Logingrupa\Studybook\Models
 *
 * @mixin \October\Rain\Database\Builder
 * @mixin \Eloquent
 *
 * @property integer $id
 * @property bool $active
 * @property string $name
 * @property string $slug
 * @property string $code
 * @property string $external_id
 * @property string $preview_text
 * @property string $description
 * @property int $view_count
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 * @property \System\Models\File $file
 * @property \System\Models\File $preview_image
 * @property \October\Rain\Database\Collection|\System\Models\File[] $images
 */
class Course extends ExportModel
{
    use Sluggable;
    use Validation;
    use ActiveField;
    use NameField;
    use SlugField;
    use CodeField;
    use ExternalIDField;
    use TraitCached;

    /** @var string */
    public $table = 'logingrupa_studybook_courses';
    /** @var array */
    public $implement = [
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];
    /** @var array */
    public $translatable = [
        'name',
        'preview_text',
        'description',
    ];
    /** @var array */
    public $attributeNames = [
        'name' => 'lovata.toolbox::lang.field.name',
        'slug' => 'lovata.toolbox::lang.field.slug',
    ];
    /** @var array */
    public $rules = [
        'name' => 'required',
        'slug' => 'required|unique:logingrupa_studybook_courses',
    ];
    /** @var array */
    public $slugs = [
        'slug' => 'name'
    ];
    /** @var array */
    public $jsonable = [
        'settings',
    ];
    /** @var array */
    public $fillable = [
        'active',
        'name',
        'slug',
        'code',
        'external_id',
        'preview_text',
        'description',
    ];
    /** @var array */
    public $cached = [
        'id',
        'active',
        'name',
        'slug',
        'code',
        'external_id',
        'view_count',
        'preview_text',
        'description',
        'preview_image',
        'file',
        'images',
        'price',
        'old_price',
        'available_seats',
        'duration_days',
        'student_count',
        'settings',
    ];
    /** @var array */
    public $dates = [
        'created_at',
        'updated_at',
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
    public $belongsTo = [];
    /** @var array */
    public $belongsToMany = [
        'availabledates' => [
            'Logingrupa\Studybook\Models\AvailableDate',
            'table' => 'logingrupa_studybook_course_dates',
            'key'      => 'course_id',
            'otherKey' => 'date_id',
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
        'preview_image' => 'System\Models\File',
        'file' => 'System\Models\File',
        'import_file' => [\System\Models\File::class, 'public' => false],
    ];
    /** @var array */
    public $attachMany = [
        'images' => 'System\Models\File'
    ];

    /**
     * Parse CSV file
     * @param array $arColumns
     * @param null|string $sSessionKey
     * @return array
     */
    public function exportData($arColumns, $sSessionKey = null): array
    {
        if (empty($arColumns)) {
            return [];
        }

        $obCourseList = Course::all();
        $obCourseList->each(function($obCourseList) use ($arColumns) {
            $obCourseList->addVisible($arColumns);
        });

        return $obCourseList->toArray();
    }
}
