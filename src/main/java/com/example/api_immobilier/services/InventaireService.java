package com.example.api_immobilier.services;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.api_immobilier.models.Inventaire;
import com.example.api_immobilier.models.InventaireImpl;
import com.example.api_immobilier.models.PeriodeInventaire;
import com.example.api_immobilier.repositorys.InventaireRepository;

@Service
public class InventaireService {

    @Autowired
    private InventaireRepository inventaireRepository;

    public List<Inventaire> getAll() {
        return inventaireRepository.findAll();
    }

    public List<Inventaire> getByPeriode(Long id_periode) {
        PeriodeInventaire periodeInventaire = new PeriodeInventaire();
        periodeInventaire.setId_periode_inventaire(id_periode);
        return inventaireRepository.findByPeriodeInventaire(periodeInventaire);
    }

    public Inventaire getById(Long id) {
        return inventaireRepository.findById(id).orElse(null);
    }

    public InventaireImpl getByCodificationAndPeriodeInventaire(Long id_codifiction, Long id_periode_inventaire) {
        System.out.println("********************** " + id_periode_inventaire + " " + id_codifiction);

        return inventaireRepository.findInventaireExitant(id_periode_inventaire, id_codifiction);
    }

    public Inventaire createOrUpdate(Inventaire inventaire) throws Exception {
        return inventaireRepository.save(inventaire);
    }

}
