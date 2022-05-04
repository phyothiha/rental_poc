<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // STATUS TYPE
    // 0 - PENDING
    // 1 - DECLINED
    // 2 - ACCEPTED

    protected $guarded = [];

    protected $appends = ['status_text', 'attachments'];

    protected $hidden = ['passport_front', 'nrc_front', 'nrc_back'];

    // public function getImagePathAttribute()
    // {
    //     // return asset('storage/rentals/gTK1osDrVKkK2sCQhaCMjRsAyUPOLxFV5Pr5LNx9.png');
    // }

    public function getStatusTextAttribute()
    {
        switch ($this->attributes['status']) {
            case 1:
                return 'DECLINED';
            case 2:
                return 'ACCEPTED';
            default:
                return 'PENDING';
        }
    }

    public function getAttachmentsAttribute()
    {
        return [
            $this->passport_front,
            $this->nrc_front,
            $this->nrc_back,
        ];
    }

    public function getPassportFrontAttribute($value)
    {
        return $value ? $this->image_url($value) : null;
    }

    public function getNrcFrontAttribute($value)
    {
        return $value ? $this->image_url($value) : null;
    }

    public function getNrcBackAttribute($value)
    {
        return $value ? $this->image_url($value) : null;
    }

    private function image_url($img_path)
    {
        return asset("storage/rentals/{$img_path}");
    }
}
