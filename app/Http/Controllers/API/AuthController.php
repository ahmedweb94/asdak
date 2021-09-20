<?php

namespace App\Http\Controllers\API;

use App\Helper\General;
use App\Helper\Traits\RESTApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordFormRequest;
use App\Http\Requests\Auth\ForgetPasswordFormRequest;
use App\Http\Requests\Auth\LoginUserFormRequest;
use App\Http\Requests\Auth\RegisterUserFormRequest;
use App\Http\Requests\Auth\ResetPasswordFormRequest;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use App\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use RESTApi;
    protected $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function login(LoginUserFormRequest $request)
    {
        try {
            if ($user = $this->userRepo->where('phone', $request->phone)->first()) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('token')->plainTextToken;
                    $data['token'] = $token;
                    $data['user'] = new UserResource($user);
                    return $this->sendJson($data);
                }
            }
            return $this->sendError(__('admin.login_error'), 422);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function register(RegisterUserFormRequest $request)
    {
        try {
            $user = $this->userRepo->create($request->validated());
            $token = $user->createToken('token')->plainTextToken;
            $data['token'] = $token;
            $data['user'] = new UserResource($user);
            return $this->sendJson($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function profile()
    {
        $data['token'] = auth()->user()->createToken('token')->plainTextToken;
        $data['user'] = new UserResource(auth()->user());
        return $this->sendJson($data);
    }

    public function forgetPassword(ForgetPasswordFormRequest $request)
    {
        try {
            if ($user = $this->userRepo->where('phone', $request->phone)->first()) {
                $user->verification_code = General::quickRandom();
                $user->save();
                return $this->sendJson(['message' => trans('admin.verification'), 'code' => $user->verification_code]);
            } else {
                return $this->sendError(trans('admin.no_user_found'), 404);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function reset(ResetPasswordFormRequest $request)
    {
        try {
            $user = $this->userRepo->where('phone', $request->phone)->firstOrFail();
            if ($user->verification_code == $request->code) {
                $user->password = $request->validated()['password'];
                $user->verification_code = null;
                $user->save();
                $data['token'] = $user->createToken('token')->plainTextToken;
                $data['user'] = new UserResource($user);
                return $this->sendJson($data);
            } else {
                return $this->sendError(trans('api.code_not_valid'), 406);
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function changePassword(ChangePasswordFormRequest $request)
    {
        try {
            if (Hash::check($request->validated()['old_password'], auth()->user()->password)) {
                auth()->user()->update([
                    'password' => $request->validated()['password'],
                ]);
                return $this->sendJson(trans('admin.password_changed'));
            }
            return $this->sendError(trans('admin.password_error'), 406);

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $user = $this->userRepo->update(auth()->id(),$request->validated());
            $data['token'] = $user->createToken('token', ['role:user'])->plainTextToken;
            $data['user'] = new UserResource($user);
            return $this->sendJson($data);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

    public function logout()
    {
        try {
            \auth()->user()->currentAccessToken()->delete();
            return $this->sendJson(trans('admin.logout'), 200);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 500);
        }
    }

}
