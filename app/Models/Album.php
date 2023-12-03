<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;


class Album extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'album_cover',
    ];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }



    /**
     * Pełna ścieżka do zdjęcia produktu.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function image(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if ($value === null) {
                    return null;
                }
                return config('filesystems.images_dir') . '/' . $value;
            },
        );
    }

    /**
     * Zwraca adres URL zdjęcia produktu
     *
     * @return string
     */
    public function imageUrl(): string
    {
        return $this->imageExists()
            ? Storage::url($this->image)
            : Storage::url(
                config('filesystems.default_image')
            );
    }

    /**
     * Sprawdza, czy zdjęcie istnieje dla produktu
     *
     * @return boolean
     */
    public function imageExists(): bool
    {
        return $this->image !== null
            && Storage::disk('public')->exists($this->image);
    }
}
