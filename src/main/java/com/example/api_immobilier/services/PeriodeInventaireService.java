package com.example.api_immobilier.services;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Sort;
import org.springframework.stereotype.Service;

import com.example.api_immobilier.models.PeriodeInventaire;
import com.example.api_immobilier.repositorys.PeriodeInventaireRepository;

import jakarta.transaction.Transactional;

@Service
@Transactional
public class PeriodeInventaireService {

    @Autowired
    private PeriodeInventaireRepository periodeInventaireRepository;

    public List<PeriodeInventaire> getAll() {
        return periodeInventaireRepository.findAll(Sort.by(Sort.Direction.DESC, "isActive"));
    }

    public PeriodeInventaire getIsActive() {
        return periodeInventaireRepository.findByIsActive(true);
    }

    public PeriodeInventaire getById(Long id) {
        return periodeInventaireRepository.findById(id).orElse(null);
    }

    @Transactional
    public PeriodeInventaire activeOrDiseable(PeriodeInventaire periodeInventaire) {
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

    @Transactional
    public PeriodeInventaire createOrUpdate(PeriodeInventaire periodeInventaire) throws Exception {
        Object result = new Object();
        if (!(periodeInventaire.getId_periode_inventaire() != 0 ||
                periodeInventaire.getId_periode_inventaire() != null)) {
            result = periodeInventaireRepository.findAll();

            if (((List<PeriodeInventaire>) result).size() > 0) {

                for (PeriodeInventaire element : (List<PeriodeInventaire>) result) {
                    element.setIsActive(false);
                }

                periodeInventaireRepository.saveAll((List<PeriodeInventaire>) result);

            }

            periodeInventaire.setIsActive(true);
        }

        return periodeInventaireRepository.save(periodeInventaire);
    }

}
