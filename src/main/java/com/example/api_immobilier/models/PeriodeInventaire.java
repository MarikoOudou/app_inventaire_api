package com.example.api_immobilier.models;

import java.util.Date;
import java.util.Set;

import jakarta.annotation.Nullable;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;
import jakarta.persistence.Table;
import lombok.Data;

@Entity
@Table(name = "periode_inventaire")
@Data
public class PeriodeInventaire {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id_periode_inventaire;

    @Nullable
    private String libelle;
    @Nullable
    private String n_bordereau;
    @Nullable
    private boolean isActive;
    @Nullable
    private Date date_debut;
    @Nullable
    private Date date_fin;

    @OneToMany
    Set<Inventaire> inventaires;

}
