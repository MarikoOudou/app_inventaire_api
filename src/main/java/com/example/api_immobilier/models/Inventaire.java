package com.example.api_immobilier.models;

import java.util.Date;

import jakarta.annotation.Nullable;
import jakarta.persistence.*;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.NotNull;
import lombok.Data;

@Entity
@Table(name = "inventaire")
@Data
public class Inventaire {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id_inventaire;
    @Nullable
    private String etat; // bon, defaillant
    @Nullable
    private String nom_agent;
    @NotNull
    @NotBlank(message = "n° inventaire is not null")
    @Column(unique = true)
    private String n_inventaire;
    @Nullable
    private String observations;
    @Nullable
    private String libelle_immo;
    @Nullable
    private String libelle_localisation;
    @Nullable
    private String code_localisation;
    @Nullable
    private String libelle_complementaire;
    @Nullable
    private Date date_inventaire;

    @ManyToOne(cascade = CascadeType.DETACH)
    @JoinColumn(name = "id_codification", nullable = false)
    Codification codification;

    @ManyToOne(cascade = CascadeType.DETACH)
    @JoinColumn(name = "id_periode_inventaire", nullable = false)
    PeriodeInventaire periodeInventaire;

    @ManyToOne(cascade = CascadeType.DETACH)
    @JoinColumn(name = "userId", nullable = true)
    Users user;
}
