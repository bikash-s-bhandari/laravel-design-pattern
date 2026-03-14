<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    // Status constants
    public const STATUS_INACTIVE = 0;
    public const STATUS_ACTIVE   = 1;
    public const STATUS_SUSPENDED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    // public function lastLogin()
    // {
    //     return $this->belongsTo(Login::class);
    // }

    // public function scopeWithLastLogin($query)
    // {
    //     return $query->addSelect(['last_login_id' => Login::select('id')
    //         ->whereColumn('user_id', 'users.id')->latest()->take(1)])
    //         ->with('lastLogin');
    // }

    public function lastLogin()
    {
        return $this->hasOne(Login::class)->latestOfMany();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeSearch($query, string $search)
    {
        collect(str_getcsv($search, ' ', '"'))->filter()->each(function ($term) use ($query) {
            // $term = '%' . $term . '%';
            $term = $term . '%';
            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', $term) //add index on name column
                    ->orWhere('email', 'like', $term) //add index on email column
                    ->orWhereHas('company', function ($query) use ($term) {
                        $query->where('name', 'like', $term); //add index on company name column
                    });
            });
        });
    }

    public function scopeSearchCompany($query, string $search)
    {
        //orWhere ko satta join  gare query ko performance ali ramro hunxa but still index use hudena
        $query->join('companies', 'users.company_id', '=', 'companies.id');

        collect(str_getcsv($search, ' ', '"'))->filter()->each(function ($term) use ($query) {
            $term = $term . '%';
            $query->where(function ($query) use ($term) {
                $query->where('users.name', 'like', $term)
                    ->orWhere('users.email', 'like', $term)
                    ->orWhere('companies.name', 'like', $term);
            });
        });

        return $query;
    }

    //this is better than scopeSearchCompany because it uses index on company name column
    public function scopeSearchCompanyWithIndex($query, string $search)
    {
        collect(str_getcsv($search, ' ', '"'))->filter()->each(function ($term) use ($query) {
            $term = $term . '%';
            $query->where(function ($query) use ($term) {
                $query->where('users.name', 'like', $term)
                    ->orWhere('users.email', 'like', $term)
                    ->orWhereIn('company_id', Company::query()->where('name', 'like', $term)->pluck('id'));
            });
        });
    }
}
