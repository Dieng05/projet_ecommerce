package Bamba.sn.Backend.web;


import Bamba.sn.Backend.services.ClientService;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api")
public class ClientRestController {

    final ClientService clientService;
    public ClientRestController(ClientService clientService) {
        this.clientService = clientService;
    }
}
