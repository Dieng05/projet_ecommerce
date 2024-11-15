package Bamba.sn.Backend.repositories;

import Bamba.sn.Backend.entities.Categorie;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import jakarta.transaction.Transactional;

@Repository
@Transactional

public interface CategorieRepository extends JpaRepository<Categorie, Long> {
}
