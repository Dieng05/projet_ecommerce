package Bamba.sn.Backend.web;

import Bamba.sn.Backend.entities.Produit;
import Bamba.sn.Backend.services.ProduitService;
import jakarta.persistence.EntityNotFoundException;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/produits")
public class ProduitRestController {

    final ProduitService produitService;

    public ProduitRestController(ProduitService produitService) {
        this.produitService = produitService;
    }

    // Créer un produit
    @PostMapping("/produit")
    public ResponseEntity<Produit> createProduit(@RequestBody Produit produit) {
        produitService.createProduit(produit);
        return new ResponseEntity<>(produit, HttpStatus.CREATED);
    }

    // Supprimer un produit par ID
    @DeleteMapping("/delete/{id}")
    public ResponseEntity<Void> deleteProduit(@PathVariable long id) {
        produitService.deleteProduit(id);
        return new ResponseEntity<>(HttpStatus.NO_CONTENT);
    }

    // Récupérer tous les produits
    @GetMapping("/all")

    List<Produit>getAllProduits(){

                return this.produitService.getAllProduits();
    }

    // Mettre à jour un produit par ID
    @PutMapping("/update/{id}")
    public ResponseEntity<Produit> updateProduit(@PathVariable long id, @RequestBody Produit produit) {
        produitService.updateClient(produit, id);  // Met à jour les informations du produit
        return new ResponseEntity<>(produit, HttpStatus.OK);
    }

    // Récupérer un produit par ID
        @GetMapping("/recup/{id}")
    public ResponseEntity<Produit> getProduitById(@PathVariable long id) {
        Produit produit = produitService.getAllProduits().stream()
                .filter(p -> p.getIdProduit() == id)
                .findFirst()
                .orElseThrow(() -> new EntityNotFoundException("Produit non trouvé avec l'id : " + id));
        return new ResponseEntity<>(produit, HttpStatus.OK);
    }
    @GetMapping("/categorie/{categorieId}")
    public ResponseEntity<List<Produit>> getProduitsByCategorieId(@PathVariable long categorieId) {
        List<Produit> produits = produitService.getProduitsByCategorieId(categorieId);
        return new ResponseEntity<>(produits, HttpStatus.OK);
    }
}
