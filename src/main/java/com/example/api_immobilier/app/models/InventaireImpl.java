package com.example.api_immobilier.app.models;

import java.util.Date;

public interface InventaireImpl {

    public Long getId_inventaire();

    public String getEtat();

    public String getNom_agent();

    public String getObservations();

    public Date getDate_inventaire();
}
