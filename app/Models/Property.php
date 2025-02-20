<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperProperty
 */
class Property extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'surface',
        'rooms',
        'bedrooms',
        'floor',
        'price',
        'address',
        'city',
        'postal_code',
        'sold',
    ];

    public function options(): BelongsToMany
    {
        return $this->belongsToMany(Option::class);
    }

    public function getSlug(): string
    {
        return Str::slug($this->title);
    }

    public function pictures(): HasMany
    {
        return $this->hasMany(Picture::class);
    }

    /**
     * @param UploadedFile[] $files
     */
    public function attachFiles(array $files)
    {
        $pictures = [];

        foreach ($files as $file) {
            if ($file->getError()) {
                continue;
            }

            $filename = $file->store("properties/" . $this->id, 'public');

            $this->pictures()->create([
                "filename" => $filename,
            ]);
        }
        if (count($pictures) > 0) {
            $this->pictures()->createMany($pictures);
        }
    }

    public function getPicture(): ?Picture
    {
        return $this->pictures()->first();
    }

    public function scopeAvailable(Builder $builder, bool $available = true): Builder
    {
        return $builder->where("sold", !$available);
    }

    public function scopeRecent(Builder $builder): Builder
    {
        return $builder->orderBy("created_at", "desc");
    }
}
