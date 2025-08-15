<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    public function approve(User $user, Project $project): bool
    {
        return $user->role === 'manager' && $project->status === 'Pending';
    }

    public function reject(User $user, Project $project): bool
    {
        return $user->role === 'manager' && $project->status === 'Pending';
    }
}
