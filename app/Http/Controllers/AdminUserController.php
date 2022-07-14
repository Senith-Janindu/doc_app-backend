<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Service\AdminUserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminUserController extends Controller
{
    protected AdminUserService $adminUserService;
    protected ResponseHelper $responseHelper;
    public function __construct(AdminUserService $adminUserService, ResponseHelper $responseHelper)
    {
        $this->adminUserService = $adminUserService;
        $this->responseHelper  =$responseHelper;
    }

    public function register(Request $request)
    {
        return $this->adminUserService->register($request);

    }

    public function login(Request $request)
    {
        return $this->adminUserService->login($request->all());
    }

    public function passwordUpdate(Request $request)
    {
        return $this->adminUserService->passwordUpdate($request->all());
    }

    public function logout(Request $request)
    {
        $logoutStatus = $this->adminUserService->logout($request);
        switch ($logoutStatus) {
            case true:
                return $this->responseHelper->response('success', 'Successfully Logged Out', null, Response::HTTP_OK);
            default:
            case false:
            return $this->responseHelper->response('failed', 'Unauthenticated', null, Response::HTTP_OK);
        }
    }
    //
}
