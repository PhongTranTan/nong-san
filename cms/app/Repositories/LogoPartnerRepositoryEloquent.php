<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LogoPartnerRepository;
use App\Models\LogoPartner;

/**
 * Class ContactRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LogoPartnerRepositoryEloquent extends BaseRepository implements LogoPartnerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LogoPartner::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function datatable()
    {
        return $this->model->select('*')->orderByDesc('created_at');
    }
}
