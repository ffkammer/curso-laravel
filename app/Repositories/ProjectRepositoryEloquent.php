<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Entities\Project;

/**
 * Class ProjectRepositoryEloquent
 * @package namespace CodeProject\Repositories;
 */
class ProjectRepositoryEloquent extends BaseRepository implements ProjectRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() {
        return Project::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $project_id
     * @param $user_id
     * @return bool
     */
    public function isOwner($project_id, $user_id) {
        if (count($this->findWhere(['id'=>$project_id,'owner_id'=>$user_id]))>0){
            return true;
        }
        return false;
    }

    public function hasMember($project_id, $user_id) {
        $project = $this->find($project_id);

        foreach($project->members as $member) {
            if ($member->id == $user_id) {
                return true;
            }
        }

        return false;
    }
}
