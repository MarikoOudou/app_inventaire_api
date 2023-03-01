package com.example.api_immobilier.repositorys;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import com.example.api_immobilier.models.Inventaire;
import com.example.api_immobilier.models.InventaireImpl;
import com.example.api_immobilier.models.PeriodeInventaire;

@Repository
public interface InventaireRepository extends JpaRepository<Inventaire, Long> {

    List<Inventaire> findByPeriodeInventaire(PeriodeInventaire periodeInventaire);

    @Query(value = "SELECT * FROM inventaire WHERE id_periode_inventaire = :id_periode_inventaire AND id_codification = :id_codification", nativeQuery = true)
    InventaireImpl findInventaireExitant(
            @Param("id_periode_inventaire") Long id_periode_inventaire,
            @Param("id_codification") Long id_codification);

    @Query(value = "SELECT * FROM inventaire ORDER BY date_inventaire DESC", nativeQuery = true)
    List<InventaireImpl> findAllByOrderDate();

}
