<?php namespace Logingrupa\Studybook\Models;

use Backend\Models\ImportModel;
use Illuminate\Support\Carbon;
use October\Rain\Database\Traits\Sluggable;
use October\Rain\Database\Traits\Validation;
use Kharanenka\Scope\ActiveField;
use Kharanenka\Scope\NameField;
use Kharanenka\Scope\SlugField;
use Kharanenka\Scope\CodeField;
use Kharanenka\Scope\ExternalIDField;
use Lovata\Toolbox\Traits\Helpers\TraitCached;
use RainLab\User\Models\User;

/**
 * Class Reservation
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
 * @property \October\Rain\Argon\Argon $created_at
 * @property \October\Rain\Argon\Argon $updated_at
 * @property \System\Models\File $file
 * @property \System\Models\File $preview_image
 * @property \October\Rain\Database\Collection|\System\Models\File[] $images
 */
class Reservation extends ImportModel
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
    public $table = 'logingrupa_studybook_reservations';
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
//        'name' => 'required',
        'slug' => 'unique:logingrupa_studybook_reservations',
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
        'name',
        'slug',
        'note',
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
        'note',
        'reservation_id',
        'student_id',
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
    public $hasMany = [
        'transactions' => Transaction::class,
    ];
    /** @var array */
    public $belongsTo = [
        'student' => User::class,
        'course' => Course::class,
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
     * Scope a query to only include future dates.
     */
    public function scopeExcludeExpiredDates($query)
    {
        return $query->where('start_at', '>=', Carbon::yesterday());
    }

    // Before saving concatenate fields in cssClass field
    public function beforeSave()
    {
        // dd(post()['Collection']);
        if (empty(post())) {
            return;
        }
        $this->slug = uniqid(false);
        $this->name = $this->course->name;
//      @TODO: Cannot unlink Student, throws error, insert check if field is available
        $this->full_name = $this->student->name . " " . $this->student->surname;
        $this->email = $this->student->email;
        $this->price = $this->price * 100;
        $this->old_price = $this->old_price * 100;

    }

    public function afterSave()
    {
//        dd($this->student);
        if (empty(post())) {
            return;
        }
//        DID NOT WORK
//        $this->full_name = $this->student->name . " " . $this->student->surname;
//        $this->email = $this->student->email;
//        $this->phone = $this->student->phone;
    }

    public function listReservationDates(): array
    {
        return $this->where('start_at', '>=', Carbon::yesterday())
                    ->groupBy('start_at')
                    ->pluck('start_at', 'start_at')
                    ->toArray();
    }

    /**
     * Format price with 2 decimals before making form
     */
    public function filterFields($fields, $context){
        if (is_null($this->price) || is_null($this->old_price)) {
            return;
        }
        if (empty($this->course_id))
            return;
        if ($context === 'create' || $context === 'relation') {
            $course = (new \Logingrupa\Studybook\Models\Course)->find($this->course_id);
            $price = $course->price;
            $old_price = $course->old_price;

            $fields->price->value = $price /100;
            $fields->old_price->value = $old_price /100;
        } else {
//          @TODO: when updating Reservations course price all the time divides by 100
            $fields->price->value = $fields->price->value / 100;
            $fields->old_price->value = $fields->old_price->value / 100;
        }
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
                $obReservation = new Reservation();
                $obReservation->fill($arData);
                $obReservation->save();
                $this->logCreated();
            } catch (\Exception $obException) {
                $this->logError($sRow, $obException->getMessage());
            }
        }
    }
}
