<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ProjectController extends Controller
{
    /**
     * @var
     */
    private $repository;
    /**
     * @var
     */
    private $service;

    /**
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
    public function __construct(ProjectRepository $repository, ProjectService $service) {
        $this->repository = $repository;
        $this->service    = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id    = Authorizer::getResourceOwnerId();
        return $this->repository->with(['owner'])->with(['client'])->findWhere(['owner_id'=>$user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->CheckProjectPermissions($id)==false) {
            return ['error'=>'Access Forbidden'];
        }
        return $this->repository->with(['owner'])->with(['client'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->CheckProjectOwner($id)==false) {
            return ['error'=>'Access Forbidden'];
        }
        return $this->service->update($request->all(),$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->CheckProjectOwner($id)==false) {
            return ['error'=>'Access Forbidden'];
        }
        $this->repository->delete($id);
    }

    /**
     * @param $project_id
     * @return mixed
     */
    private function CheckProjectOwner($project_id) {
        $user_id    = Authorizer::getResourceOwnerId();
        return $this->repository->isOwner($project_id,$user_id);
    }

    /**
     * @param $project_id
     * @return mixed
     */
    private function CheckProjectMember($project_id) {
        $user_id    = Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($project_id,$user_id);
    }

    private function CheckProjectPermissions($project_id) {
        if ($this->CheckProjectOwner($project_id) or $this->CheckProjectMember($project_id)) {
            return true;
        }

        return false;
    }


}
