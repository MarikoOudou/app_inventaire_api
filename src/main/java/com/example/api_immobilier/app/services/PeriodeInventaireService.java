package com.example.api_immobilier.app.services;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.api_immobilier.app.models.PeriodeInventaire;
import com.example.api_immobilier.app.repositorys.PeriodeInventaireRepository;

@Service
public class PeriodeInventaireService {

    @Autowired
    private PeriodeInventaireRepository periodeInventaireRepository;

    public List<PeriodeInventaire> getAll() {
        return periodeInventaireRepository.findAll();
    }

    public PeriodeInventaire getById(Long id) {
        return periodeInventaireRepository.findById(id).orElse(null);
    }

    public PeriodeInventaire createOrUpdate(PeriodeInventaire periodeInventaire) throws Exception {
        return periodeInventaireRepository.save(periodeInventaire);
    }

}
