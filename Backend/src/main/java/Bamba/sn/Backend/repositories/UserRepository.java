package Bamba.sn.Backend.repositories;

import Bamba.sn.Backend.entities.User;
import org.springframework.data.jpa.repository.JpaRepository;

public interface UserRepository extends JpaRepository<User, Long> {
}
