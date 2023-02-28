<?php

namespace App\Http\Controllers;

use App\Models\Inventaire;
use App\Http\Requests\StoreInventaireRequest;
use App\Http\Requests\UpdateInventaireRequest;
use App\Models\codification;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class InventaireController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'etat' => 'required',
                'nom_agent' => 'required',
                'observations' => 'required',
                'date_inventaire' => 'required',
                'id_codification' => 'required',
                'id_periode_inventaire' => 'required',
                'userId'
            ]);

            return self::sendResponse(true, Response::HTTP_CREATED, "", Inventaire::create($request->all()));
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
     * Display the specified resource.
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
     * Display the specified resource.
     */
    public function getInventaireByCodificationAndPeriodeInventaire(int $id_codification, int $id_periode_inventaire)
    {
        try {

            return self::sendResponse(
                true,
                Response::HTTP_OK,
                "",
                tap(
                    Inventaire::where(
                        'id_codification',
                        '=',
                        $id_codification,
                        'AND',
                        'id_periode_inventaire',
                        '=',
                        $id_periode_inventaire
                    )->firstOrFail(),
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->validate($request, [
                'etat' => 'required',
                'nom_agent' => 'required',
                'observations' => 'required',
                'date_inventaire' => 'required',
                'id_codification' => 'required',
                'id_periode_inventaire' => 'required',
                'userId'
            ]);
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
