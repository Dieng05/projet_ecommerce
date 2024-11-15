package Bamba.sn.Backend.web;

import Bamba.sn.Backend.entities.Categorie;
import Bamba.sn.Backend.entities.Produit;
import Bamba.sn.Backend.services.CategorieService;
import jakarta.persistence.EntityNotFoundException;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/Categories")
public class CategorieRestController {

    final CategorieService categorieService;

    CategorieRestController(CategorieService categorieService) {
         this.categorieService = categorieService;
    }
    // Créer un produit
    @PostMapping("/categorie")
    public ResponseEntity<Categorie> createCategorie(@RequestBody Categorie categorie) {
        categorieService.createCategorie(categorie);
        return new ResponseEntity<>(categorie, HttpStatus.CREATED);
    }
    // Supprimer un produit par ID
    @PostMapping("/delete/{id}")
    public ResponseEntity<Void> deleteCategorie(@PathVariable long id) {
        categorieService.deleteCategorie(id);
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }

    // Récupérer tous les produits
    @GetMapping("/all")
    List<Categorie> getAllCategories() {

        return this.categorieService.getAllCategories();
    }

    // Mettre à jour un produit par ID
    @PutMapping("/update/{id}")
    public ResponseEntity<Categorie> updateCategorie(@PathVariable long id, @RequestBody Categorie categorie) {
        categorieService.updateCategorie(categorie, id);// Met à jour les informations du produit
        return new ResponseEntity<>(categorie, HttpStatus.OK);
    }

    
    // Récupérer un produit par ID
    @GetMapping("/recup/{id}")
    public ResponseEntity<Categorie> getCategorieById(@PathVariable long id) {
        Categorie categorie = categorieService.getAllCategories().stream()
                .filter(p -> p.getIdCategorie() == id)
                .findFirst()
                .orElseThrow(() -> new EntityNotFoundException("Categorie non trouvé avec l'id : " + id));
        return new ResponseEntity<>(categorie, HttpStatus.OK);
    }

}
