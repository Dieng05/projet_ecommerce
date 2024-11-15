package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.Categorie;
import Bamba.sn.Backend.entities.Produit;
import Bamba.sn.Backend.repositories.CategorieRepository;
import jakarta.persistence.EntityNotFoundException;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;

import java.util.List;

@Service
public class CategorieServiceImpl implements CategorieService {

    @Override
    public void createCategorie(Categorie categorie) {

        this.categorieRepository.save(categorie);
    }
    @Override
    public void deleteCategorie(long id) {

        this.categorieRepository.deleteById(id);

    }

    @Override
    public List<Categorie> getAllCategories() {
        return this.categorieRepository.findAll();
    }

    @Override

    public void updateCategorie(Categorie categorie, long id) {
        // Vérifie si la catégorie existe, sinon lève une exception
        Categorie c = this.categorieRepository.findById(id)
                .orElseThrow(() -> new EntityNotFoundException("Catégorie non trouvée"));

        // Mets à jour le nom de la catégorie
        c.setNomCategorie(categorie.getNomCategorie());

        // Sauvegarde la catégorie mise à jour dans la base de données
        this.categorieRepository.save(c);
    }
    private final CategorieRepository categorieRepository;
    public CategorieServiceImpl(CategorieRepository categorieRepository) {
        this.categorieRepository = categorieRepository;
    }



}
