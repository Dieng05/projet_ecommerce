package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.Client;
import Bamba.sn.Backend.repositories.ClientRepository;
import jakarta.persistence.EntityNotFoundException;
import org.springframework.stereotype.Service;

import java.util.List;
@Service
public class ClientServiceImpl implements ClientService{
    private final ClientRepository ClientRepository;
    public ClientServiceImpl(ClientRepository ClientRepository) {
        this.ClientRepository = ClientRepository;
    }
    @Override
    public void createClient(Client client) {

        this.ClientRepository.save(client);
    }

    @Override
    public void deleteClient(long id) {
        this.ClientRepository.deleteById(id);

    }

    @Override
    public List<Client> getAllClients() {
        return this.ClientRepository.findAll();
    }

    @Override
    public void updateClient(Client client, long id) {

        Client cl = this.ClientRepository.findById(id)
                .orElseThrow(() -> new EntityNotFoundException("Client not found with id: " + id));

        // Update fields
        cl.setAdresse(client.getAdresse());
        cl.setNom(client.getNom());
        cl.setPrenom(client.getPrenom());
        cl.setTelephone(client.getTelephone());
        cl.setEmail(client.getEmail());
        cl.setUser(client.getUser());

        // Save the updated client
        ClientRepository.save(cl);
    }
}
