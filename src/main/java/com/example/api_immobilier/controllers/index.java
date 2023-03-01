package com.example.api_immobilier.controllers;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

import io.swagger.v3.oas.annotations.Operation;

@CrossOrigin
@RestController
public class index {

    @Operation(summary = "Get All Codification")
    @GetMapping("/")
    public ResponseEntity<Object> getAllCodification() {
        return ResponseEntity.ok("hello APP GEST-IMM");
    }

}
