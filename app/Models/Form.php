<?php

namespace App\Models;

use Str;
use App\Forms\Form as BaseForm;
use Illuminate\Database\Eloquent\Model;
use Kris\LaravelFormBuilder\FormBuilder;
use Mpociot\Versionable\VersionableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Form extends Model
{
    //use VersionableTrait;
    use LogsActivity;

    protected static $logAttributes = ['name', 'text', '*'];

    public function __construct()
    {
        parent::__construct();
        //$this->enableApprovals();
    }

    //
    protected $with = [
        'fields',
    ];

    protected $fillable = [
        'title',
        'intro',
        'notification',
        'confirmation_text',
    ];

    /*public function getRouteKeyName()
    {
    return 'uuid';
    }*/

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($form) {
            $form->uuid = (string) Str::uuid();
        });

        /*static::creating(function ($model) {
            //$model->version_approved = false;
        });

        static::saving(function (Model $model) {
            if ($model->exists) {
                // need to replicate this and make a new version
                $version = $model->replicate();
                $version->version_parent = $model->id;
                dd($version);
                $version->push();
            }
        });*/
    }

    public function getBuilder()
    {
        $formBuilder = app(FormBuilder::class);

        return $formBuilder->create(BaseForm::class, [
            'method' => 'POST',
            'url'    => route('form.submit', $this),
        ]);
    }

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function getConfirmationAttribute()
    {
        return $this->confirmation_text ?? 'You have successfully submitted the form.';
    }
}
