<?php

namespace App\Http\Controllers;

use App\Models\codification;
use App\Http\Requests\StorecodificationRequest;
use App\Http\Requests\UpdatecodificationRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

use function GuzzleHttp\Promise\all;

class CodificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        try {
            return self::sendResponse(true, Response::HTTP_OK, "", codification::all());
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
                'n_inventaire' => 'required',
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
                'code_localisation',
                'libelle_agence',
                'libelle_localisation'
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

    public function stores(Request $request)
    {

        try {

            $resul  = [];

            foreach ($request->all() as $key => $value) {

                $exist = codification::where('n_inventaire', '=', $value['n_inventaire'])->first();

                if ($exist) {
                    return $this->sendResponse(false,
                    Response::HTTP_BAD_REQUEST, "le numero ".$value['n_inventaire']." inventaire existe!");
                }

                $resul [$key] = codification::create($value);

            }

            return $this->sendResponse(true, Response::HTTP_OK, "", $resul);


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
            return self::sendResponse(true, Response::HTTP_OK, "", codification::findOrFail($id));
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, "La codification n'existe pas");
        }
    }

    /**
     * Display the specified resource by email
     */
    public function findByNIntenventaire(string $n_inventaire)
    {

        try {

            return self::sendResponse(true, Response::HTTP_OK, "", codification::where('n_inventaire', '=', $n_inventaire)->firstOrFail());
        } catch (QueryException $e) {
            return $this->sendResponse(false, Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            return $this->sendResponse(false, Response::HTTP_FOUND, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecodificationRequest $request, int $id)
    {
        //

        try {
            // $this->validate($request, [
            //     'n_inventaire' => 'required',
            //     'code_guichet',
            //     'departement',
            //     'n_serie',
            //     'direction',
            //     'famille',
            //     'libelle_famille',
            //     'sous_libelle_famille',
            //     'niveau',
            //     'service',
            //     'sous_famille',
            //     'code_localisation',
            //     'libelle_agence',
            //     'libelle_localisation'
            // ]);

            $codification = codification::findOrFail($id);
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
