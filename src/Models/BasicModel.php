<?php

namespace Vegacms\Cms\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BasicModel extends Model implements BasicModelInterface
{
    use HasFactory;

    /**
     * Get the slug for a model instance
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->id;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        if (strpos(get_called_class(), 'Vegacms\Cms') !== false) {
            $factoryClass = str_replace('Models', 'Database\Factories', get_called_class()) . 'Factory';

            return resolve($factoryClass);
        }

        return Factory::factoryForModel(get_called_class());
    }
}
