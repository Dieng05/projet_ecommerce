package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.Commande;
import Bamba.sn.Backend.repositories.CommandeRepository;
import jakarta.persistence.EntityNotFoundException;
import org.springframework.stereotype.Service;

import java.util.List;


@Service
public class CommandeServiceImpl implements CommandeService{

    private final CommandeRepository commandeRepository;
    public CommandeServiceImpl(CommandeRepository commandeRepository) {
        this.commandeRepository = commandeRepository;
    }
    @Override
    public void createCommande(Commande commande) {
        this.commandeRepository.save(commande);
    }

    @Override
    public void deleteCommande(long id) {

        this.commandeRepository.deleteById(id);
    }

    @Override
    public List<Commande> getAllCommandes() {
        return this.commandeRepository.findAll();
    }

    @Override
    public void updateCommande(Commande commande, long id) {

        Commande cd = this.commandeRepository.findById(id)
                .orElseThrow(() -> new EntityNotFoundException("Commande not found with id: " + id));

        // Update fields
        cd.setClient(commande.getClient());
        cd.setProduit(commande.getProduit());
        cd.setDateCommande(commande.getDateCommande());

        // Save the updated commande
        commandeRepository.save(cd);


    }
}
