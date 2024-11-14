package com.example.api_immobilier.models;

import java.util.Set;

import jakarta.annotation.Nullable;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;
import jakarta.persistence.Table;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.NotNull;
import lombok.Data;

@Entity
@Table(name = "codification")
@Data
public class Codification {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id_codification;
    @NotNull
    @NotBlank(message = "n° inventaire is not null")
    @Column(unique = true)
    private String n_inventaire;
    @Nullable
    private String code_guichet;
    @Nullable
    private String departement;
    @Nullable
    private String n_serie;
    @Nullable
    private String direction;
    @Nullable
    private String famille;
    @Nullable
    private String libelle_famille;
    @Nullable
    private String libelle_immo;
    @Nullable
    private String sous_libelle_famille;
    @Nullable
    private String libelle_complementaire;
    @Nullable
    private String code_localisation;
    @Nullable
    private String niveau;
    @Nullable
    private String service;
    @Nullable
    private String sous_famille;
    @Nullable
    private String codeLocalisation;
    @Nullable
    private String libelle_agence;
    @Nullable
    private String libelle_localisation;
    @OneToMany
    Set<Inventaire> inventaires;

}
