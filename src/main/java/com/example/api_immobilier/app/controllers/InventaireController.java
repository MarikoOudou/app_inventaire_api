package com.example.api_immobilier.app.controllers;

import java.util.Collections;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.server.ResponseStatusException;

import com.example.api_immobilier.app.models.Codification;
import com.example.api_immobilier.app.models.Inventaire;
import com.example.api_immobilier.app.models.PeriodeInventaire;
import com.example.api_immobilier.app.models.ResponseData;
import com.example.api_immobilier.app.services.CodificationService;
import com.example.api_immobilier.app.services.InventaireService;
import com.example.api_immobilier.app.services.PeriodeInventaireService;

import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.tags.Tag;

@CrossOrigin
@RestController
@Tag(name = "Inventaire", description = "")
public class InventaireController {

    @Autowired
    private InventaireService inventaireService;

    @Autowired
    private CodificationService codificationService;

    @Autowired
    private PeriodeInventaireService periodeInventaireService;

    @Operation(summary = "Get All inventaires")
    @GetMapping("/inventaires")
    public Object getAll() {
        return Collections.singletonMap("data", inventaireService.getAll());
    }

    @Operation(summary = "Get All inventaires by periode")
    @GetMapping("/inventaires/{id_periode_inventaire}")
    public Object getByPeriode(@PathVariable Long id_periode_inventaire) {
        return Collections.singletonMap("data", inventaireService.getByPeriode(id_periode_inventaire));
    }

    @Operation(summary = "Get inventaire by codification and periode")
    @GetMapping("/inventaires/codification/{id_codification}/periodeinventaire/{id_periode_inventaire}")
    public ResponseData getInventaireByCodificationAndPeriodeInventaire(
            @PathVariable Long id_codification,
            @PathVariable Long id_periode_inventaire) {
        Object result = new Object();

        result = inventaireService.getByCodificationAndPeriodeInventaire(
                id_codification,
                id_periode_inventaire);

        if (result == null) {
            return new ResponseData("", false, result);
        }

        return new ResponseData("", true, result);
    }

    @Operation(summary = "Get by id")
    @GetMapping("/inventaire/{id}")
    public Object getByIdInventaire(@PathVariable Long id) {
        return Collections.singletonMap("data", inventaireService.getById(id));
    }

    @Operation(summary = "Create inventaire")
    @PostMapping("/inventaire")
    public Object createInventaire(@RequestBody Inventaire inventaire) throws Exception {

        try {
            Object result = new Object();

            result = codificationService.getById(inventaire.getCodification().getId_codification());

            if (result == null) {
                return Collections.singletonMap("message", "La codification n'exite pas");
            }

            result = periodeInventaireService.getById(inventaire.getPeriodeInventaire().getId_periode_inventaire());

            if (result == null) {
                return Collections.singletonMap("message", "La periode n'exite pas");
            }

            result = inventaireService.getByCodificationAndPeriodeInventaire(
                    inventaire.getCodification().getId_codification(),
                    inventaire.getPeriodeInventaire().getId_periode_inventaire());
            System.out.println("********************** " + result);
            if (result != null) {
                return Collections.singletonMap("message", "Vous avez deja faire l'inventaire de ce meuble!");
            }

            result = inventaireService.createOrUpdate(inventaire);

            return Collections.singletonMap("data", result);
        } catch (Exception err) {
            System.out.println(err.getMessage());
            throw new ResponseStatusException(
                    HttpStatus.NOT_FOUND, err.getMessage(), err);
        }

    }

    @Operation(summary = "Update inventaire")
    @PutMapping("/inventaire/{id}")
    public Object updateInventaire(@RequestBody Inventaire inventaire, @PathVariable Long id) throws Exception {
        Object result = new Object();
        result = inventaireService.getById(id);

        if (result == null) {
            return Collections.singletonMap("message", "L'inventaire n'exite pas! ");
        }

        inventaire.setId_inventaire(id);
        result = inventaireService.createOrUpdate(inventaire);

        return Collections.singletonMap("data", result);
    }

}
