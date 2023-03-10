<?php

namespace App\Http\Controllers;

use App\Models\Inventaire;
use App\Http\Requests\StoreInventaireRequest;
use App\Http\Requests\UpdateInventaireRequest;
use App\Models\codification;
use App\Models\PeriodeInventaire;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InventaireController extends Controller
{
    /**
     * @OA\Get(
     *      path="/inventaires",
     *      operationId="getAllInventaire",
     *      tags={"inventaire"},
     *      summary="Get inventaires information",
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

        try {
            return self::sendResponse(true, Response::HTTP_OK, "", Inventaire::all()->map(function (Inventaire $inventaire) {


                $inventaire['codification'] = $inventaire->codification;
                $inventaire['periode_inventtaire'] = $inventaire->periodeInventtaire;
                $inventaire['user'] = $inventaire->user;

                unset($inventaire['id_codification']);
                unset($inventaire['id_periode_inventaire']);
                unset($inventaire['userId']);

                return $inventaire;
            }));
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }


    /**
     * @OA\Post(
     *      path="/inventaire",
     *      operationId="createInventaire",
     *      tags={"inventaire"},
     *      summary="Create inventaire",
     *      description="Returns response",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Inventaire")
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
        DB::beginTransaction();

        try {
            $this->validate($request, [
                'etat' => 'required',
                'nom_agent' => 'required',
                'observations' => 'required',
                'date_inventaire' => 'required',

                'libelle_immo' => 'required',
                'libelle_localisation' => 'required',
                'code_localisation' => 'required',
                'libelle_complementaire' => 'required',

                'id_codification' => 'required',
                'id_periode_inventaire' => 'required',

                'userId'
            ]);


            $codification = codification::find($request->all()['id_codification']);
            // dd($codification);
            if ($codification == null) {
                DB::rollback();
                return self::sendResponse(false, Response::HTTP_NOT_FOUND, "La codification n'exite pas", $codification);
            }
            // dd($codification);

            $codification->libelle_immo           = $request->all()['libelle_immo'];
            $codification->libelle_localisation   = $request->all()['libelle_localisation'];
            $codification->code_localisation      = $request->all()['code_localisation'];
            $codification->libelle_complementaire = $request->all()['libelle_complementaire'];
            $codification                         = $codification->update();

            $periodeInventaireService = PeriodeInventaire::find($request->all()['id_periode_inventaire']);
            // dd($codification);
            if ($periodeInventaireService == null) {
                DB::rollback();
                return self::sendResponse(false, Response::HTTP_NOT_FOUND, "La période n'exite pas", $periodeInventaireService);
            }

            $inventaire = Inventaire::where( 'id_codification', '=', $request->all()['id_codification'],
                'AND', 'id_periode_inventaire', '=', $request->all()['id_periode_inventaire']
            )->first();
            if ($inventaire != null) {
                DB::rollback();
                return self::sendResponse(false, Response::HTTP_NOT_FOUND, "Vous avez déjà fait l'inventaire de ce meuble!", $inventaire);
            }
            DB::commit();

            return self::sendResponse(true, Response::HTTP_CREATED, "L'inventaire a été éffectué avec succes", Inventaire::create($request->all()));
        } catch (ValidationException $exception) {
            return $this->sendResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $exception->getMessage());
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            DB::rollback();
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/inventaire/{id}",
     *      operationId="getByIdInventaire",
     *      tags={"inventaire"},
     *      summary="Get inventaire information",
     *      description="Returns data",
     *      @OA\Parameter(
     *          name="id",
     *          description="inventaire id",
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
        try {
            return self::sendResponse(
                true,
                Response::HTTP_OK,
                "",
                tap(
                    Inventaire::findOrFail($id),
                    (function (Inventaire $inventaire) {

                        $inventaire['codification'] = $inventaire->codification;
                        $inventaire['periode_inventtaire'] = $inventaire->periodeInventtaire;
                        $inventaire['user'] = $inventaire->user;

                        unset($inventaire['id_codification']);
                        unset($inventaire['id_periode_inventaire']);
                        unset($inventaire['userId']);

                        return $inventaire;
                    })
                )
            );
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_NOT_FOUND, $e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/inventaires/{id_periode_inventaire}",
     *      operationId="getByIdPeriodeInventaire",
     *      tags={"inventaire"},
     *      summary="Get inventaire information",
     *      description="Returns data",
     *      @OA\Parameter(
     *          name="id periode inventaire",
     *          description="inventaire id_periode_inventaire",
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
    public function getByPeriode(int $id_periode_inventaire)
    {
        try {
            return self::sendResponse(
                true,
                Response::HTTP_OK,
                "",

                Inventaire::where('id_periode_inventaire', '=', $id_periode_inventaire)->get()
                    ->map(
                        (function (Inventaire $inventaire) {

                            $inventaire['codification'] = $inventaire->codification;
                            $inventaire['periode_inventtaire'] = $inventaire->periodeInventtaire;
                            $inventaire['user'] = $inventaire->user;

                            unset($inventaire['id_codification']);
                            unset($inventaire['id_periode_inventaire']);
                            unset($inventaire['userId']);

                            return $inventaire;
                        })
                    )

            );
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_NOT_FOUND, $e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *      path="/inventaires/codification/{id_codification}/periodeinventaire/{id_periode_inventaire}",
     *      operationId="getInventaireByCodificationAndPeriodeInventaire",
     *      tags={"inventaire"},
     *      summary="Get inventaire information",
     *      description="Returns data",
     *      @OA\Parameter(
     *          name="id codification",
     *          description="inventaire id_codification",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="id periode inventaire",
     *          description="inventaire id_periode_inventaire",
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
    public function getInventaireByCodificationAndPeriodeInventaire(int $id_codification, int $id_periode_inventaire)
    {
        try {

            $inventaire = Inventaire::where(
                'id_codification',
                '=',
                $id_codification,
                'AND',
                'id_periode_inventaire',
                '=',
                $id_periode_inventaire
            )->first();

            if ( $inventaire == null) {
                return self::sendResponse(
                    true,
                    Response::HTTP_OK,
                    "L'inventaire n'est pas fait.",
                    $inventaire
                );
            } else {
                return self::sendResponse(
                    false,
                    Response::HTTP_NOT_ACCEPTABLE,
                    "L'inventaire est déjà fait."
                );
            }



        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_NOT_FOUND, $e->getMessage());
        }
    }

    /**
     * @OA\Put(
     *      path="/inventaire/{id}",
     *      operationId="updateInventaire",
     *      tags={"inventaire"},
     *      summary="Update existing inventaire",
     *      description="Returns response",
     *      @OA\Parameter(
     *          name="id",
     *          description="inventaire id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Inventaire")
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
                'etat' => 'required',
                'nom_agent' => 'required',
                'observations' => 'required',

                // 'libelle_immo' => 'required',
                'libelle_localisation' => 'required',
                'code_localisation' => 'required',
                // 'libelle_complementaire' => 'required',
            ]);


            // $inventaire->etat                   = $request->all()['etat'];
            // $inventaire->nom_agent              = $request->all()['nom_agent'];
            // $inventaire->observations           = $request->all()['observations'];
            // $inventaire->libelle_localisation   = $request->all()['libelle_localisation'];
            // $inventaire->code_localisation      = $request->all()['code_localisation'];
            // $inventaire->update();


            $inventaire = Inventaire::findOrFail($id);
            $inventaire->update($request->all());

            return self::sendResponse(true, Response::HTTP_OK, "", $inventaire);


        } catch (ValidationException $exception) {
            return $this->sendResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $exception->getMessage());
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventaire $inventaire)
    {
        //
    }


}
