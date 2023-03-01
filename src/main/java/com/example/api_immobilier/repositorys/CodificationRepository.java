package com.example.api_immobilier.repositorys;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import com.example.api_immobilier.models.Codification;

@Repository
public interface CodificationRepository extends JpaRepository<Codification, Long> {
    Codification findByCodeLocalisation(String code_localisation);

    // SELECT * FROM foo ORDER BY foo_date DESC

    @Query(value = "SELECT * FROM codification ORDER BY id_codification DESC", nativeQuery = true)
    List<Codification> findAllByOrderDate();

    @Query(value = "SELECT * FROM codification WHERE n_inventaire = :n_inventaire", nativeQuery = true)
    Codification findByN_inventaire(@Param("n_inventaire") String n_inventaire);
}
