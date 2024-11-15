package Bamba.sn.Backend.repositories;

import Bamba.sn.Backend.entities.Commande;
import jakarta.transaction.Transactional;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;


@Repository
@Transactional
public interface CommandeRepository extends JpaRepository<Commande, Long> {
}
