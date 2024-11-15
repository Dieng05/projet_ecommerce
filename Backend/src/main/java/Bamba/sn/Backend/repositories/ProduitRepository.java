package Bamba.sn.Backend.repositories;

import Bamba.sn.Backend.entities.Produit;
import jakarta.transaction.Transactional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
@Transactional
public interface ProduitRepository extends JpaRepository<Produit, Long> {

    List<Produit> findByCategorie_IdCategorie(long idCategorie);
}
