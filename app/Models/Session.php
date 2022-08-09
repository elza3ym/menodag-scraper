<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['pattern', 'start', 'is_running', 'time', 'current_number'];

    /**
     * checks if the session or any session is running
     * @param int|null $id
     * @return bool
     */
    public static function isRunning($id = null) : bool {
        $qb = self::where('is_running', true);
        if ($id) {
            $qb->where('id', $id);
        }
        return $qb->count() > 0;
    }

    /**
     * checks if the session or any session is running
     * @param int|null $id
     * @return bool
     */
    public static function getRunning() {
        $qb = self::where('is_running', true);
        return $qb->first();
    }



    public function data() {
        return $this->hasMany(Data::class);
    }

    public function getDataCollectedCount() {
        $this->data()->count();
    }
}
