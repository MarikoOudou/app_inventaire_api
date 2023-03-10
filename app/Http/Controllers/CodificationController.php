<?php

namespace App\Http\Controllers;

use App\Models\codification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


class CodificationController extends Controller
{
    /**
     * @OA\Get(
     *      path="/codifications",
     *      operationId="getAllCodification",
     *      tags={"codifications"},
     *      summary="Get codifications information",
     *      description="Returns data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function index()
    {
        //

        try {
            return self::sendResponse(true, Response::HTTP_OK, "", codification::all()->map(
                function (codification $codification) {
                    $codification['id_codification'] = $codification->id;

                    return $codification;
                }
            ));
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }


    /**
     * @OA\Post(
     *      path="/codification",
     *      operationId="createCodification",
     *      tags={"codifications"},
     *      summary="Create codification",
     *      description="Returns response",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/codification")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */

    public function store(Request $request)
    {

        try {
            $this->validate($request, [
                'n_inventaire' => 'required',


                'libelle_immo' => 'required',
                'libelle_localisation' => 'required',
                'code_localisation' => 'required',
                'libelle_complementaire' => 'required',

                'code_guichet',
                'departement',
                'n_serie',
                'direction',
                'famille',
                'libelle_famille',
                'sous_libelle_famille',
                'niveau',
                'service',
                'sous_famille',
                'libelle_agence',
            ]);

            $exist = codification::where('n_inventaire', '=', $request['n_inventaire'])->first();

            if ($exist) {
                return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, "le numero inventaire existe!");
            }

            return codification::create($request->all());
        } catch (ValidationException $exception) {
            return $this->sendResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $exception->getMessage());
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *      path="/codifications",
     *      operationId="createsCodification",
     *      tags={"codifications"},
     *      summary="Create full codification",
     *      description="Returns response",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/codification")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function stores(Request $request)
    {

        try {

            $resul  = [];
            $i = 0;

            foreach ($request->all() as $key => $value) {

                $exist = codification::where('n_inventaire', '=', $value['n_inventaire'])->first();

                if ($exist) {
                    $resul[$i] = $exist;
                } else {
                    codification::create($value);
                }
                $i++;
            }

            return $this->sendResponse(true, Response::HTTP_OK, "les meubles non enregistrer sont au nombre de ".count($resul), $resul ? $resul: []);
        } catch (ValidationException $exception) {
            return $this->sendResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $exception->getMessage());
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/codifications/{id}",
     *      operationId="getByIdCodification",
     *      tags={"codifications"},
     *      summary="Get codification information",
     *      description="Returns data",
     *      @OA\Parameter(
     *          name="id",
     *          description="codification id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(int $id)
    {
        //

        try {
            return self::sendResponse(true, Response::HTTP_OK, "", codification::findOrFail($id));
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, "La codification n'existe pas");
        }
    }

    /**
     * @OA\Get(
     *      path="/codifications/n_inventaire/{n_inventaire}",
     *      operationId="getCodificationByNInventaire",
     *      tags={"codifications"},
     *      summary="Get codification information",
     *      description="Returns data",
     *      @OA\Parameter(
     *          name="n° inventaire",
     *          description="codification n_inventaire",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function findByNIntenventaire(string $n_inventaire)
    {

        try {

            $codification = codification::where('n_inventaire', '=', $n_inventaire)->first();

            if ($codification == null) {
                return self::sendResponse(false, Response::HTTP_NOT_ACCEPTABLE, "Le numéro inventaire n'existe pas", $codification);
            } else {
                return self::sendResponse(true, Response::HTTP_OK, "la codification existe", $codification);
            }


        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * @OA\Put(
     *      path="/codifications/{id}",
     *      operationId="updateCodification",
     *      tags={"codifications"},
     *      summary="Update existing codification",
     *      description="Returns response",
     *      @OA\Parameter(
     *          name="id",
     *          description="codification id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/codification")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function update(Request $request, int $id)
    {

        try {

            $this->validate($request, [
                'n_inventaire' => 'required',


                'libelle_immo' => 'required',
                'libelle_localisation' => 'required',
                'code_localisation' => 'required',
                'libelle_complementaire' => 'required',

                'code_guichet',
                'departement',
                'n_serie',
                'direction',
                'famille',
                'libelle_famille',
                'sous_libelle_famille',
                'niveau',
                'service',
                'sous_famille',
                'libelle_agence',
            ]);

            $codification = codification::findOrFail($id);

            if ($codification->n_inventaire != $request->all()["n_inventaire"]) {
                # code...
                // dd("Difference");

                $exist = codification::where('n_inventaire', '=', $request['n_inventaire'])->first();

                if ($exist) {
                    return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, "le numéro inventaire existe!");
                }

            }

            $codification->update($request->all());

            return self::sendResponse(true, Response::HTTP_OK, "", $codification);
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(codification $codification)
    {
        //
    }


}
