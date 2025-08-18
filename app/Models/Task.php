<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task query()
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Task whereUserId($value)
 * @mixin \Eloquent
 */
class Task extends Model {
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
