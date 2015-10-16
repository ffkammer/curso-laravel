<?php

namespace CodeProject\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Entities\Client;

/**
 * Class ClientRepositoryEloquent
 * @package CodeProject\Repositories
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
	/**
	 * Specify Model class name
	 *
	 * @return mixed
	 */
	public function model() {
		return Client::class;
	}
}