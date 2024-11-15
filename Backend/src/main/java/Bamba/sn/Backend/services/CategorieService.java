package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.Categorie;

import java.util.List;

public interface CategorieService   {
    void createCategorie(Categorie categorie);
    void deleteCategorie(long id);
    List<Categorie> getAllCategories();
    void updateCategorie(Categorie categorie, long id);

}
