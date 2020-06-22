<?php

namespace Vegacms\Cms\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Vegacms\Cms\Models\Group;

trait CmsUser
{

    /**
     * The groups of the user
     *
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Get the slug for a model instance
     *
     * @return string
     */
    public function getSlug(): string
    {
        return $this->id;
    }
}
