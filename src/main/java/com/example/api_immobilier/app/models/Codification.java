package com.example.api_immobilier.app.models;

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

@Entity
@Table(name = "codification")
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
    private String sous_libelle_famille;
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

    public Codification(Long id_codification, String n_inventaire, String code_guichet, String departement,
            String n_serie, String direction, String famille, String libelle_famille, String sous_libelle_famille,
            String niveau, String service, String sous_famille, String codeLocalisation, String libelle_agence,
            String libelle_localisation) {
        this.id_codification = id_codification;
        this.n_inventaire = n_inventaire;
        this.code_guichet = code_guichet;
        this.departement = departement;
        this.n_serie = n_serie;
        this.direction = direction;
        this.famille = famille;
        this.libelle_famille = libelle_famille;
        this.sous_libelle_famille = sous_libelle_famille;
        this.niveau = niveau;
        this.service = service;
        this.sous_famille = sous_famille;
        this.codeLocalisation = codeLocalisation;
        this.libelle_agence = libelle_agence;
        this.libelle_localisation = libelle_localisation;
    }

    public Codification() {
    }

    public Long getId_codification() {
        return id_codification;
    }

    public void setId_codification(Long id_codification) {
        this.id_codification = id_codification;
    }

    public String getN_inventaire() {
        return n_inventaire;
    }

    public void setN_inventaire(String n_inventaire) {
        this.n_inventaire = n_inventaire;
    }

    public String getCode_guichet() {
        return code_guichet;
    }

    public void setCode_guichet(String code_guichet) {
        this.code_guichet = code_guichet;
    }

    public String getDepartement() {
        return departement;
    }

    public void setDepartement(String departement) {
        this.departement = departement;
    }

    public String getN_serie() {
        return n_serie;
    }

    public void setN_serie(String n_serie) {
        this.n_serie = n_serie;
    }

    public String getDirection() {
        return direction;
    }

    public void setDirection(String direction) {
        this.direction = direction;
    }

    public String getFamille() {
        return famille;
    }

    public void setFamille(String famille) {
        this.famille = famille;
    }

    public String getLibelle_famille() {
        return libelle_famille;
    }

    public void setLibelle_famille(String libelle_famille) {
        this.libelle_famille = libelle_famille;
    }

    public String getSous_libelle_famille() {
        return sous_libelle_famille;
    }

    public void setSous_libelle_famille(String sous_libelle_famille) {
        this.sous_libelle_famille = sous_libelle_famille;
    }

    public String getNiveau() {
        return niveau;
    }

    public void setNiveau(String niveau) {
        this.niveau = niveau;
    }

    public String getService() {
        return service;
    }

    public void setService(String service) {
        this.service = service;
    }

    public String getSous_famille() {
        return sous_famille;
    }

    public void setSous_famille(String sous_famille) {
        this.sous_famille = sous_famille;
    }

    public String getCodeLocalisation() {
        return codeLocalisation;
    }

    public void setCodeLocalisation(String codeLocalisation) {
        this.codeLocalisation = codeLocalisation;
    }

    public String getLibelle_agence() {
        return libelle_agence;
    }

    public void setLibelle_agence(String libelle_agence) {
        this.libelle_agence = libelle_agence;
    }

    public String getLibelle_localisation() {
        return libelle_localisation;
    }

    public void setLibelle_localisation(String libelle_localisation) {
        this.libelle_localisation = libelle_localisation;
    }

    // public Set<Inventaire> getInventaires() {
    // return inventaires;
    // }

    // public void setInventaires(Set<Inventaire> inventaires) {
    // this.inventaires = inventaires;
    // }

}
