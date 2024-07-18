<?php

namespace App\Models;

use App\Traits\UserRewardTrait;
use Aws\S3\Crypto\UserAgentTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
// use Tymon\JWTAuth\Contracts\JWTSubject;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use  HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['membership_type_id', 'membership_no','wallet_id','vnuban','user_pin', 'reward_id','reward_point','reward_benefits','dedicated_account_number', 'account_status',  'wallet_balance','account_number','account_name','loyalty_class_id','loyalty_class',  'bank_name', 'customer_code','last_funded_amount', 'last_membership_amount', 'is_deleted', 'deletion_date',
        'firstname','dob', 'lastname','phone', 'email','password','profile_photo', 'has_active_account', 'account_is_locked', 'account_is_pnd', 'has_membership',  'visit_count', 'gender',  'membership_start_on','membership_expire_on','membership_last_activated_on','last_login_ip','last_login_at','verify_code','is_verified', 'slug'
    ];
    protected $appends = ['membership_status'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password','user_pin',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];
    //mutators
    public function setFirstnameAttribute($value){
        $this->attributes['firstname'] = $value;
        $this->attributes['slug'] = Str::slug($value).time();

    }
    public function setPasswordAttribute($value){
        $this->attributes['password'] = Hash::make($value);
    }
    public function setUserPinAttribute($value){
        $this->attributes['user_pin'] = Hash::make($value);
    }
    public function setRewardBenefitsAttribute($value)
    {
        $this->attributes['reward_benefits'] = json_encode($value);
    }
    public function getRewardBenefitsAttribute()
    {
        return json_decode($this->attributes['reward_benefits']);
    }
    public function hasSocialLinked($service)
    {
        $r =  $this->providers->where('service', $service)->count();

        return (bool) $r;
    }
    public function getMembershipStatusAttribute()
    {

        // $today = Carbon::today()->format('Y-m-d');
        // $expire = $this->attributes['membership_expire_on'];
        // return $expire > $today ? 1 : 0;
        return false;
    }


    // public function getJWTIdentifier()
    // {
    //    return $this->getKey();
    // }

    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }


    /**RELATIONShIP */
    public function bankAccounts()
    {
        return $this->hasMany(AppVirtualAccount::class, 'user_id');
    }
    public function providers(){
        return $this->hasMany(SocialAuthProvider::class,'user_id','id');
    }
    public function reward(){
        return $this->belongsTo(Reward::class,'reward_id')->withDefault();
    }
    public function loyalty(){
        return $this->belongsTo(LoyaltyClass::class,'loyalty_class_id');
    }
    public function membershipType(){
        return $this->belongsTo(MembershipType::class,'membership_type_id');
    }
    public function beachBooking(){
        return $this->hasMany(BeachBooking::class,'user_id');
    }
    public function submembers()
    {
        return $this->hasMany(SubMember::class, 'user_id');
    }
    public function eventBooking(){
        return $this->hasMany(ShowBooking::class,'user_id');
    }



   //


}
