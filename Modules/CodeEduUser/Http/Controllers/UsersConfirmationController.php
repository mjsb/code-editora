<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Repositories\UsersRepository;
use Jrean\UserVerification\Traits\VerifiesUsers;

class UsersConfirmationControllerController extends Controller
{
    use VerifiesUsers;

    /**
     * @var UsersRepository
     */
    private $repository;

    /**
     * UsersController constructor.
     * @param UsersRepository $repository
     */

    public function __construct(UsersRepository $repository)
    {
        $this->repository = $repository;
    }
}
