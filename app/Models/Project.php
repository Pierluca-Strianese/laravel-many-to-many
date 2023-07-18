<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Tecnology;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function tecnologies() {
        return $this->belongsToMany(Tecnology::class);
    }
}
