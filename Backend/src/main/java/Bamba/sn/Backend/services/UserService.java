package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.Produit;
import Bamba.sn.Backend.entities.User;

import java.util.List;

public interface UserService {

    void createUser(User user);
    void deleteUser(long id);
    List<User> getAllProduits();
    void updateClient(User user, long id);

}
