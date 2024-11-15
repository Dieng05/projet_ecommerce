package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.Categorie;
import Bamba.sn.Backend.entities.Client;

import java.util.List;

public interface ClientService {
    void createClient(Client client);
    void deleteClient(long id);
    List<Client> getAllClients();
    void updateClient(Client client, long id);
}
