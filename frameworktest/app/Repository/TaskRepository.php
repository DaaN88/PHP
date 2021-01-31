<?php


namespace App\Repository;

use app\User;


class TaskRepository
{

    /**
     * Get all of the tasks for a given user.
     *
     * @param User $user
     *
     * @return Collection
     */

    public function forUser(User $user)
    {
        return $user->tasks()
            ->orderBy('created_at', 'asc')
            ->get();
    }

}
