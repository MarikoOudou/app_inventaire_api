package com.example.api_immobilier.app.controllers;

import java.util.Collections;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RestController;

import com.example.api_immobilier.app.models.PeriodeInventaire;
import com.example.api_immobilier.app.services.PeriodeInventaireService;

import io.swagger.v3.oas.annotations.Operation;
import org.springframework.web.bind.annotation.RequestBody;

import io.swagger.v3.oas.annotations.tags.Tag;

@CrossOrigin
@RestController
@Tag(name = "Periode Inventaire", description = "")
public class PeriodeInventaireController {

    @Autowired
    private PeriodeInventaireService periodeInventaireService;

    @Operation(summary = "Get All periode inentaire")
    @GetMapping("/periodeinentaire")
    public Object getAllPeriodeInventaire() {
        return Collections.singletonMap("data", periodeInventaireService.getAll());
    }

    @Operation(summary = "Get by id")
    @GetMapping("/periodeinentaire/{id}")
    public Object getByIdPeriodeInventaire(@PathVariable Long id) {
        return Collections.singletonMap("data", periodeInventaireService.getById(id));
    }

    @Operation(summary = "Create periode inentaire")
    @PostMapping("/periodeinentaire")
    public Object createPeriodeInventaire(@RequestBody PeriodeInventaire periodeInventaire) throws Exception {
        Object result = new Object();

        result = periodeInventaireService.createOrUpdate(periodeInventaire);
        // System.out.println("---------------------" + periodeInventaire.toString());

        return Collections.singletonMap("data", result);
    }

    @Operation(summary = "Update periode inentaire")
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

}
