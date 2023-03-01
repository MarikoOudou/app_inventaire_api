package com.example.api_immobilier.models;

import java.util.Date;
import java.util.Set;

import io.swagger.v3.oas.annotations.tags.Tag;
import jakarta.annotation.Nullable;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;
import jakarta.persistence.Table;

@Entity
@Table(name = "periode_inventaire")
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

    public PeriodeInventaire() {
    }

    public PeriodeInventaire(Long id_periode_inventaire, String libelle, String n_bordereau, boolean isActive,
            Date date_debut, Date date_fin) {
        this.id_periode_inventaire = id_periode_inventaire;
        this.libelle = libelle;
        this.n_bordereau = n_bordereau;
        this.isActive = isActive;
        this.date_debut = date_debut;
        this.date_fin = date_fin;
    }

    public Long getId_periode_inventaire() {
        return id_periode_inventaire;
    }

    public void setId_periode_inventaire(Long id_periode_inventaire) {
        this.id_periode_inventaire = id_periode_inventaire;
    }

    public String getLibelle() {
        return libelle;
    }

    public void setLibelle(String libelle) {
        this.libelle = libelle;
    }

    public String getN_bordereau() {
        return n_bordereau;
    }

    public void setN_bordereau(String n_bordereau) {
        this.n_bordereau = n_bordereau;
    }

    public boolean getIsActive() {
        return isActive;
    }

    public void setIsActive(boolean isActive) {
        this.isActive = isActive;
    }

    public Date getDate_debut() {
        return date_debut;
    }

    public void setDate_debut(Date date_debut) {
        this.date_debut = date_debut;
    }

    public Date getDate_fin() {
        return date_fin;
    }

    public void setDate_fin(Date date_fin) {
        this.date_fin = date_fin;
    }

    @Override
    public String toString() {
        return "PeriodeInventaire [id_periode_inventaire=" + id_periode_inventaire + ", libelle=" + libelle
                + ", n_bordereau=" + n_bordereau + ", isActive=" + isActive + ", date_debut=" + date_debut
                + ", date_fin=" + date_fin + ", inventaires=" + inventaires + "]";
    }

    // public Set<Inventaire> getInventaires() {
    // return inventaires;
    // }

    // public void setInventaires(Set<Inventaire> inventaires) {
    // this.inventaires = inventaires;
    // }

}
