<?php

namespace App\Http\Controllers;

use App\Models\PeriodeInventaire;
use App\Http\Requests\StorePeriodeInventaireRequest;
use App\Http\Requests\UpdatePeriodeInventaireRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PeriodeInventaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            return self::sendResponse(true, Response::HTTP_OK, "", PeriodeInventaire::all());
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
                'libelle'=> 'required',
                'n_bordereau' => 'required',
                'isActive'=> 'required',
                'date_debut'=> 'required',
                'date_fin'=> 'required',
            ]);

            $getAll = PeriodeInventaire::all();

            if ($getAll->count() > 0) {
                foreach ($getAll as $key => $value) {
                    $value['isActive'] = false;
                    $value->save();
                }
            }


            return self::sendResponse(true, Response::HTTP_CREATED, "", PeriodeInventaire::create($request->all()));


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
        //
        try {
            return self::sendResponse(true, Response::HTTP_OK, "", PeriodeInventaire::findOrFail($id));
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_NOT_FOUND, "La periode inventaire n'existe pas");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
        try {
            $this->validate($request, [
                'libelle'=> 'required',
                'n_bordereau' => 'required',
                'isActive'=> 'required',
                'date_debut'=> 'required',
                'date_fin'=> 'required',
            ]);

            $getAll = PeriodeInventaire::all();

            if ($getAll->count() > 0) {
                foreach ($getAll as $key => $value) {
                    $value['isActive'] = false;
                    $value->save();
                }
            }

            $periodeInventaire = PeriodeInventaire::findOrFail($id);
            $periodeInventaire->update($request->all());



            return self::sendResponse(true, Response::HTTP_CREATED, "", $periodeInventaire);


        } catch (ValidationException $exception) {
            return $this->sendResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $exception->getMessage());
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_NOT_MODIFIED, $e->getMessage());
        }
    }

        /**
     * Update the specified resource in storage.
     */
    public function activeOrDiseable(Request $request, int $id)
    {
        //
        try {
            $this->validate($request, [
                'libelle'=> 'required',
                'n_bordereau' => 'required',
                'isActive'=> 'required',
                'date_debut'=> 'required',
                'date_fin'=> 'required',
            ]);

            $getAll = PeriodeInventaire::all();

            if ($getAll->count() > 0) {
                foreach ($getAll as $key => $value) {
                    $value['isActive'] = false;
                    $value->save();
                }
            }

            $periodeInventaire = PeriodeInventaire::findOrFail($id);
            // $periodeInventaire['isActive'] = true;
            // $periodeInventaire->save();
            $periodeInventaire->update($request->all());

            return self::sendResponse(true, Response::HTTP_ACCEPTED, "", $periodeInventaire);


        } catch (ValidationException $exception) {
            return $this->sendResponse(false, Response::HTTP_UNPROCESSABLE_ENTITY, $exception->getMessage());
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_NOT_MODIFIED, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeriodeInventaire $periodeInventaire)
    {
        //
    }
}
