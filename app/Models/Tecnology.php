<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tecnology extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function projects() {
        return $this->belongsToMany(Project::class);
    }
}
