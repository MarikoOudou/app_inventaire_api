package com.example.api_immobilier.app.repositorys;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.api_immobilier.app.models.PeriodeInventaire;

@Repository
public interface PeriodeInventaireRepository extends JpaRepository<PeriodeInventaire, Long> {
    PeriodeInventaire findByIsActive(boolean isActive);

    // @Query(value = "SELECT * FROM codification ORDER BY id_codification DESC",
    // nativeQuery = true)
    // List<Codification> findAllByOrderDate();

}
