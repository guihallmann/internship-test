<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

class Person extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use HasFactory;

    public function protocols(): HasMany
    {
        return $this->hasMany(Protocol::class);
    }

    protected $table = 'people';
    protected $fillable = [
        'name',
        'birthday',
        'cpf',
        'sex',
        'city',
        'neighborhood',
        'street',
        'number',
        'complement',
    ];
}
