package Bamba.sn.Backend.services;


import Bamba.sn.Backend.entities.Commande;

import java.util.List;

public interface CommandeService {
    void createCommande(Commande commande);
    void deleteCommande(long id);
    List<Commande> getAllCommandes();
    void updateCommande(Commande commande, long id);
}
