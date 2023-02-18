package com.example.api_immobilier.app.services;

import java.util.ArrayList;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.Sort;
import org.springframework.stereotype.Service;

import com.example.api_immobilier.app.models.Codification;
import com.example.api_immobilier.app.repositorys.CodificationRepository;

@Service
public class CodificationService {

    @Autowired
    private CodificationRepository codificationRepository;

    public List<Codification> getAll() {
        return codificationRepository.findAllByOrderDate();
    }

    public Object getByCodification(String code_localisation) {
        return codificationRepository.findByCodeLocalisation(code_localisation);
    }

    public Codification getById(Long id) {
        return codificationRepository.findById(id).orElse(null);
    }

    public Codification getByNInventaire(String n_inventaire) throws Exception {
        return codificationRepository.findByN_inventaire(n_inventaire);
    }

    public Codification createOrUpdate(Codification codification) throws Exception {
        return codificationRepository.save(codification);
    }

    public List<Codification> creates(List<Codification> codifications) throws Exception {

        List<Codification> exitants = new ArrayList<Codification>();
        Codification exitant = new Codification();
        for (Codification codification : codifications) {
            exitant = codificationRepository.findByN_inventaire(codification.getN_inventaire());
            if (exitant != null) {
                exitants.add(exitant);
            } else {
                codificationRepository.save(codification);
            }
        }

        return exitants;
    }

}
