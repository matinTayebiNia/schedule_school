<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable=[
        "code",
        'userable_type',
        'userable_id',
        "expired_at",
    ];

    public $timestamps = false;

    public function userable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeVerifyCode($query , $code,  $user): bool
    {
        return !! $user->activeCode()->whereCode($code)->where('expired_at' , '>' , now())->first();
    }

    public function scopeGenerateCode($query , $user): int
    {

        if($code = $this->getAliveCodeForUser($user)) {
            $code = $code->code;
        } else {

            $user->activeCode()->delete();

            do {
                $code = mt_rand(100000, 999999);
            } while ($this->checkCodeIsUnique($user, $code));

            // store the code
            $user->activeCode()->create([
                'code' => $code,
                'expired_at' => now()->addMinutes(10)
            ]);
            session()->put("sms_expire_time",now()->addMinutes(2));
        }

        return $code;

    }

    private function checkCodeIsUnique($user, int $code): bool
    {
        return !! $user->activeCode()->whereCode($code)->first();
    }

    private function getAliveCodeForUser($user)
    {
        return $user->activeCode()->where('expired_at' , '>' , now())->first();
    }

}
