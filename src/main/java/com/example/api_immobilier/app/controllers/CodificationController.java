package com.example.api_immobilier.app.controllers;

import java.util.Collections;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.server.ResponseStatusException;
import com.example.api_immobilier.app.models.Codification;
import com.example.api_immobilier.app.services.CodificationService;
import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.tags.Tag;
import jakarta.validation.Valid;

@CrossOrigin
@RestController
@Tag(name = "Codification", description = "")
public class CodificationController {
    @Autowired
    private CodificationService codificationService;

    @Operation(summary = "Get All Codification")
    @GetMapping("/codifications")
    public ResponseEntity<Object> getAllCodification() {
        return ResponseEntity.ok(codificationService.getAll());
    }

    @Operation(summary = "Get By id")
    @GetMapping("/codifications/{id}")
    public Object getByIdCodification(@PathVariable Long id) {
        return Collections.singletonMap("data", codificationService.getById(id));
    }

    @Operation(summary = "Get by code_localisation")
    @GetMapping("/codifications/code_localisation/{code_localisation}")
    public Object getByCodeLocalisationCodification(@PathVariable String code_localisation) {
        return Collections.singletonMap("data", codificationService.getByCodification(code_localisation));
    }

    @Operation(summary = "Get by n° inventaire")
    @GetMapping("/codifications/n_inventaire/{n_inventaire}")
    public Object getByNInventaireCodification(@PathVariable String n_inventaire) throws Exception {
        return Collections.singletonMap("data", codificationService.getByNInventaire(n_inventaire));
    }

    @Operation(summary = "Create multiple codification")
    @PostMapping("/codifications")
    public Object creates(@Valid @RequestBody List<Codification> codifications) throws Exception {
        try {
            Object result = new Object();
            result = codificationService.creates(codifications);
            return Collections.singletonMap("data", result);
        } catch (Exception e) {
            // TODO: handle exception
            throw new ResponseStatusException(
                    HttpStatus.NOT_FOUND, e.getMessage(), e);
        }
        // Object result = new Object();
        // result = codificationService.creates(codifications);
        // return Collections.singletonMap("data", result);
    }

    @Operation(summary = "Create codification")
    @PostMapping("/codification")
    public Object createCodification(@RequestBody Codification codification) throws Exception {
        try {
            Object result = new Object();
            result = codificationService.getByNInventaire(codification.getN_inventaire());
            // System.out.println("--------------------------------------- " + result);

            if (result != null) {
                return Collections.singletonMap("message", "le numero inventaire existe!");
            }

            result = codificationService.createOrUpdate(codification);
            return Collections.singletonMap("data", result);
        } catch (Exception e) {
            // TODO: handle exception
            throw new ResponseStatusException(
                    HttpStatus.NOT_FOUND, e.getMessage(), e);
        }

    }

    @Operation(summary = "Update codification")
    @PutMapping("/codification/{id}")
    public Object updateCodification(@RequestBody Codification codification, @PathVariable Long id) throws Exception {
        Object result = new Object();
        try {
            result = codificationService.getById(id);

            if (result == null) {
                return Collections.singletonMap("message", "Le meuble n'exite pas! ");
            }

            // result =
            // codificationService.getByNInventaire(codification.getN_inventaire());

            // if (result != null) {
            // return Collections.singletonMap("message", "le numero inventaire existe!");
            // }

            codification.setId_codification(id);
            result = codificationService.createOrUpdate(codification);

            return Collections.singletonMap("data", result);
        } catch (Exception e) {
            // TODO: handle exception
            throw new ResponseStatusException(
                    HttpStatus.NOT_FOUND, "Foo Not Found", e);
        }

    }
}
