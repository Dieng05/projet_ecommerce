package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.Produit;

import java.util.List;

public interface ProduitService {

    void createProduit(Produit produit);
    void deleteProduit(long id);
    List<Produit> getAllProduits();
    void updateClient(Produit produit, long id);
    List<Produit> getProduitsByCategorieId(long categorieId);
}
