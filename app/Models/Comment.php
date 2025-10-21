<?php

namespace App\Models;

use App\Filters\Contracts\Filterable;
use App\Presenters\Contracts\Presentable;
use App\Presenters\Web\Comment\CommentPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use Filterable,Presentable;

    protected $guarded = ['id'];

    protected $webPresenter = CommentPresenter::class;
    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function adminReply()
    {
        return $this->hasOne(Comment::class, 'parent_id');
    }
}
