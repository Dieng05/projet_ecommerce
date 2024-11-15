package Bamba.sn.Backend.web;

import Bamba.sn.Backend.services.CommandeService;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api")
public class CommandeRestController {

    final CommandeService commandeService;
    public CommandeRestController(CommandeService commandeService) {
        this.commandeService = commandeService;
    }
}
