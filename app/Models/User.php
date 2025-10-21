<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Contracts\Bookmarkable;
use App\Contracts\Likeable;
use App\Contracts\Viewable;
use App\Filters\Contracts\Filterable;
use App\Presenters\Api\User\UserPresenter as ApiUserPresenter;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\User\UserPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, Filterable ,Presentable;

    protected $guarded = ['id'];
    protected $webPresenter = UserPresenter::class;
    protected $apiPresenter = ApiUserPresenter::class;

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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function like(Likeable $likeable): self
    {
        if ($this->hasLiked($likeable)) {
            $likeable->likes()
                ->whereHas('user', function($query) {
                    return $query->whereId($this->id);
                })
                ->delete();
            return $this;
        }else{
            (new Like())
                ->user()->associate($this)
                ->likeable()->associate($likeable)
                ->save();
            return $this;
        }


    }

    public function hasLiked(Likeable $likeable): bool
    {
        if (! $likeable->exists) {
            return false;
        }

        return $likeable->likes()
            ->whereHas('user', function($query) {
                return $query->whereId($this->id);
            })
            ->exists();
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function bookmark(Bookmarkable $bookmarkable): self
    {
        if ($this->hasBookmarked($bookmarkable)) {
            $bookmarkable->bookmarks()
                ->whereHas('user', function($query) {
                    return $query->whereId($this->id);
                })
                ->delete();
            return $this;
        }else{
            (new Bookmark())
                ->user()->associate($this)
                ->bookmarkable()->associate($bookmarkable)
                ->save();
            return $this;
        }


    }

    public function hasBookmarked(Bookmarkable $bookmarkable): bool
    {
        if (! $bookmarkable->exists) {
            return false;
        }

        return $bookmarkable->bookmarks()
            ->whereHas('user', function($query) {
                return $query->whereId($this->id);
            })
            ->exists();
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function view(Viewable $viewable): self
    {
        if ($this->hasViewed($viewable)) {
            return $this;
        }else{
            (new view())
                ->user()->associate($this)
                ->viewable()->associate($viewable)
                ->save();
            return $this;
        }


    }

    public function hasViewed(Viewable $viewable): bool
    {
        if (! $viewable->exists) {
            return false;
        }

        return $viewable->views()
            ->whereHas('user', function($query) {
                return $query->whereId($this->id);
            })
            ->exists();
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }
}
