package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.Produit;
import Bamba.sn.Backend.repositories.ProduitRepository;
import jakarta.persistence.EntityNotFoundException;
import org.springframework.stereotype.Service;

import java.util.List;
@Service
public class ProduitServiceImpl implements ProduitService {

    private final ProduitRepository produitRepository;
    public ProduitServiceImpl(ProduitRepository produitRepository) {
        this.produitRepository = produitRepository;
    }
    @Override
    public void createProduit(Produit produit) {
        this.produitRepository.save(produit);
    }

    @Override
    public void deleteProduit(long id) {
        this.produitRepository.deleteById(id);

    }

    @Override
    public List<Produit> getAllProduits() {
        return this.produitRepository.findAll();
    }

    @Override
    public void updateClient(Produit produit, long id) {

        Produit pdt = this.produitRepository.findById(id)
                .orElseThrow(() -> new EntityNotFoundException("Produit not found with id: " + id));

        // Update fields
        pdt.setNomProduit(produit.getNomProduit());
        pdt.setDescriptionProduit(produit.getDescriptionProduit());
        pdt.setPrixProduit(produit.getPrixProduit());
        pdt.setImageProduit(produit.getImageProduit());
        pdt.setCategorie(produit.getCategorie());

        // Save the updated produit
        produitRepository.save(pdt);
    }
    @Override
    public List<Produit> getProduitsByCategorieId(long categorieId) {
        return produitRepository.findByCategorie_IdCategorie(categorieId);
    }
}
