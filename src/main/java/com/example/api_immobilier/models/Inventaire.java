package com.example.api_immobilier.models;

import java.util.Date;

import jakarta.annotation.Nullable;
import jakarta.persistence.*;

@Entity
@Table(name = "inventaire")
public class Inventaire {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id_inventaire;
    @Nullable
    private String etat; // bon, defaillant
    @Nullable
    private String nom_agent;
    @Nullable
    private String observations;
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

    public Inventaire(Long id_inventaire, String etat, String nom_agent, String observations, Date date_inventaire,
            Codification codification, PeriodeInventaire periodeInventaire) {
        this.id_inventaire = id_inventaire;
        this.etat = etat;
        this.nom_agent = nom_agent;
        this.observations = observations;
        this.date_inventaire = date_inventaire;
        this.codification = codification;
        this.periodeInventaire = periodeInventaire;
        // this.user = user;
    }

    public Inventaire() {
    }

    public Long getId_inventaire() {
        return id_inventaire;
    }

    public void setId_inventaire(Long id_inventaire) {
        this.id_inventaire = id_inventaire;
    }

    public String getEtat() {
        return etat;
    }

    public void setEtat(String etat) {
        this.etat = etat;
    }

    public String getNom_agent() {
        return nom_agent;
    }

    public void setNom_agent(String nom_agent) {
        this.nom_agent = nom_agent;
    }

    public String getObservations() {
        return observations;
    }

    public void setObservations(String observations) {
        this.observations = observations;
    }

    public Date getDate_inventaire() {
        return date_inventaire;
    }

    public void setDate_inventaire(Date date_inventaire) {
        this.date_inventaire = date_inventaire;
    }

    public Codification getCodification() {
        return codification;
    }

    public void setCodification(Codification codification) {
        this.codification = codification;
    }

    public PeriodeInventaire getPeriodeInventaire() {
        return periodeInventaire;
    }

    public void setPeriodeInventaire(PeriodeInventaire periodeInventaire) {
        this.periodeInventaire = periodeInventaire;
    }

    public Users getUser() {
        return user;
    }

    public void setUser(Users user) {
        this.user = user;
    }
}
