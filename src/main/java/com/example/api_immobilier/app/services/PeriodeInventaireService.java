package com.example.api_immobilier.app.services;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.api_immobilier.app.models.PeriodeInventaire;
import com.example.api_immobilier.app.repositorys.PeriodeInventaireRepository;

import jakarta.transaction.Transactional;

@Service
@Transactional
public class PeriodeInventaireService {

    @Autowired
    private PeriodeInventaireRepository periodeInventaireRepository;

    public List<PeriodeInventaire> getAll() {
        return periodeInventaireRepository.findAll();
    }

    public PeriodeInventaire getIsActive() {
        return periodeInventaireRepository.findByIsActive(true);
    }

    public PeriodeInventaire getById(Long id) {
        return periodeInventaireRepository.findById(id).orElse(null);
    }

    @Transactional
    public PeriodeInventaire createOrUpdate(PeriodeInventaire periodeInventaire) throws Exception {
        Object result = new Object();
        result = periodeInventaireRepository.findAll();

        if (((List<PeriodeInventaire>) result).size() > 0) {

            for (PeriodeInventaire element : (List<PeriodeInventaire>) result) {
                element.setIsActive(false);
            }

            periodeInventaireRepository.saveAll((List<PeriodeInventaire>) result);

        }

        return periodeInventaireRepository.save(periodeInventaire);
    }

}
