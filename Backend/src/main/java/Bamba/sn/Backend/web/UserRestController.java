package Bamba.sn.Backend.web;

import Bamba.sn.Backend.services.UserService;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/api")
public class UserRestController {

    final UserService userService;
    public UserRestController(UserService userService) {
        this.userService = userService;
    }
}
