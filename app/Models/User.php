<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'street_address',
        'apt',
        'city',
        'state',
        'country',
        'zip',
        'phone',
        'vehicle_to',
        'account_type',
        'client_id',
        'experiense_period',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function carStates()
    {
        return $this->morphedByMany(
            CarState::class,
            'purchasable',
            'purchasable'
        );
    }

    public function priceRanges()
    {
        return $this->morphedByMany(
            PriceRange::class,
            'purchasable',
            'purchasable'
        );
    }

    public function purchasePurposes()
    {
        return $this->morphedByMany(
            PurchasePurpose::class,
            'purchasable',
            'purchasable'
        );
    }

    public function toExport()
    {
        return $this->morphedByMany(
            ToExport::class,
            'purchasable',
            'purchasable'
        );
    }

    public function vehiclesList($delimiter=", ")
    {
        $res = array();
        foreach($this->vehicles()->get() as $v)
        {
            $res[] = $v->name;
        }

        return implode($delimiter, $res);
    }

    public function managerInfo()
    {
        return $this->belongsTo(User::class,'id');
    }

    public function countryInfo()
    {
        return $this->belongsTo(Country::class,'country');
    }

    public function accountType()
    {
        return $this->belongsTo(AccountType::class,'account_type');
    }

    public static function  createUser(int $type, Request $request): User
    {
        $user = User::create([
            'name' => $request->name ?? $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'street_address' => $request->street_address,
            'apt' => $request->apt,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'vehicle_to' => $request->vehicle_to ?? 0,
            'account_type' => $type,
            'client_id' => Helper::getRandomIdWithCheck((new User), 'client_id', 6)
        ]);

        Purchasable::updateList($request, $user->id);

        return $user;
    }

    public function getName(): string
    {
        if ($this->account_type == 1) {
            return $this->name;
        }

        return $this->middle_name . ', ' . $this->first_name . ' ' . $this->last_name;
    }

    public function getShortName(): string
    {
        if ($this->account_type == 1) {
            return $this->name;
        }

        return $this->first_name . ' ' . substr($this->middle_name,0,1) . '. ' . substr($this->last_name,0,1) . '.';
    }


    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

}
