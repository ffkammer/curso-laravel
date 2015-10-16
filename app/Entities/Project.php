<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function notes() {
        return $this->hasMany(ProjectNote::class);
    }

    public function tasks() {
        return $this->hasMany(ProjectTask::class);
    }

    public function members() {
        return $this->hasMany(ProjectMember::class);
    }

}
