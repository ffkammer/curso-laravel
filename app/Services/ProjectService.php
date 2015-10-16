<?php

namespace CodeProject\Services;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Prettus\Validator\Exceptions\ValidatorException;

/**
* 
*/
class ProjectService
{
	/**
	 * @var ProjectRepository
	 */
	protected $repository;

	/**
	 * @var ProjectValidator
	 */
	protected $validator;
	
	/**
	 * @param ProjectRepository
	 */
	function __construct(ProjectRepository $repository, ProjectValidator $validator)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
	}

	public function create(array $data) {
		try {
			$this->validator->with($data)->passesOrFail();
			return $this->repository->create($data);
		} catch(ValidationException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}

	public function update(array $data, $id) {
		try {
			$this->validator->with($data)->passesOrFail();
			return $this->repository->update($data,$id);
		} catch(ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}

	public function addMember(array $data, $id) {
		try {
		} catch(ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}

	public function removeMember(array $data, $id) {
		try {
		} catch(ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}

	public function isMember(array $data, $id) {
		try {
		} catch(ValidatorException $e) {
			return [
				'error' => true,
				'message' => $e->getMessageBag()
			];
		}
	}
}