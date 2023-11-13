<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Protocol extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function followUp(): HasMany
    {
        return $this->hasMany(FollowUp::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }
    
    protected $table = 'protocols';
    protected $fillable = [
        'description',
        'deadline',
        'person_id',
        'department_id'
    ];
}
