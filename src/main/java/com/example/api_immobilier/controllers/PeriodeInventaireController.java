package com.example.api_immobilier.controllers;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PatchMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.api_immobilier.models.PeriodeInventaire;
import com.example.api_immobilier.models.ResponseData;
import com.example.api_immobilier.services.PeriodeInventaireService;

import io.swagger.v3.oas.annotations.Operation;
import org.springframework.web.bind.annotation.RequestBody;

import io.swagger.v3.oas.annotations.tags.Tag;

@CrossOrigin
@RestController
@Tag(name = "Periode Inventaire", description = "")
public class PeriodeInventaireController {

    @Autowired
    private PeriodeInventaireService periodeInventaireService;

    @Operation(summary = "Get All periode inventaire")
    @GetMapping("/periodeinentaire")
    public ResponseData getAllPeriodeInventaire() {
        Object result = new Object();
        result = periodeInventaireService.getAll();
        return new ResponseData("liste des periode inventaire", true, (List<PeriodeInventaire>) result);
    }

    @Operation(summary = "Get periode inventaire is active")
    @GetMapping("/periodeinentaire/isactive")
    public ResponseData getPeriodeInventaireIsActive() {
        Object result = new Object();
        result = periodeInventaireService.getIsActive();
        if (result == null) {
            return new ResponseData("Il n'existe pas de période d'inventaire", false, result);
        }
        return new ResponseData("periode inventaire active", true, result);
    }

    @Operation(summary = "Get by id")
    @GetMapping("/periodeinentaire/{id}")
    public Object getByIdPeriodeInventaire(@PathVariable Long id) {
        return Collections.singletonMap("data", periodeInventaireService.getById(id));
    }

    @Operation(summary = "Create periode inventaire")
    @PostMapping("/periodeinentaire")
    public Object createPeriodeInventaire(@RequestBody PeriodeInventaire periodeInventaire) throws Exception {
        Object result = new Object();

        result = periodeInventaireService.createOrUpdate(periodeInventaire);
        // System.out.println("---------------------" + periodeInventaire.toString());

        return new ResponseData("", true, result);
    }

    @Operation(summary = "Update periode inventaire")
    @PutMapping("/periodeinentaire/{id}")
    public Object updatePeriodeInventaire(@RequestBody PeriodeInventaire periodeInventaire, @PathVariable Long id)
            throws Exception {
        Object result = new Object();
        result = periodeInventaireService.getById(id);

        if (result == null) {
            return Collections.singletonMap("message", "L'inventaire n'exite pas! ");
        }

        periodeInventaire.setId_periode_inventaire(id);
        result = periodeInventaireService.createOrUpdate(periodeInventaire);

        return Collections.singletonMap("data", result);
    }

    @Operation(summary = "Update periode by isActive")
    @PatchMapping("/periodeinentaire/activeordiseable/{id}")
    public ResponseData activeOrDiseable(@RequestBody PeriodeInventaire periodeInventaire, @PathVariable Long id)
            throws Exception {
        Object result = new Object();
        result = periodeInventaireService.getById(id);

        if (result == null) {
            return new ResponseData("L'inventaire n'exite pas! ", false, result);
        }

        periodeInventaire.setId_periode_inventaire(id);
        result = periodeInventaireService.activeOrDiseable(periodeInventaire);

        return new ResponseData("L'inventaire n'exite pas! ", true, result);
    }

}
