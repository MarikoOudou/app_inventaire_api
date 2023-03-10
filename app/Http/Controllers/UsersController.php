<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    /**
     * @OA\Get(
     *      path="/users",
     *      operationId="getAllUser",
     *      tags={"Users"},
     *      summary="Get list of user",
     *      description="",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index()
    {
        //

        try {
            return self::sendResponse(true, Response::HTTP_OK, "", User::all());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try {
            $this->validate($request, [
                'fullname' => 'required',
                'email' => 'required',
                'type_user' => 'required',
            ]);

            return User::create($request->all());
        } catch (ValidationException $exception) {
            return $this->sendResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $exception->getMessage());
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        try {
            return self::sendResponse(true, Response::HTTP_OK, "", User::findOrFail($id));
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * Display the specified resource by email
     */
    public function findByEmail(Request $request)
    {

        try {
            $this->validate($request, [
                'email' => 'required'
            ]);

            $user = User::where('email', '=', $request['email'])->first();

            if ($user == null) {
                return self::sendResponse(false, Response::HTTP_NOT_FOUND, "L'utilisateur n'existe pas", $user);
            } else {
                return self::sendResponse(true, Response::HTTP_OK, "Récuperation des informations de l'utilisateur", tap($user,
                (function (User $users) {
                    $users["userId"] = $users->id;
                    return $users;
                })
                ) );
            }



        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);

        $validated = Validator::make($request->all(), [
            'fullname' => 'required',
            'email' => 'required',
            'type_user' => 'required',
        ]);

        if ($validated->fails()) {

            return self::sendResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $validated->messages());
        }

        $user->update($request->all());

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

}
