package Bamba.sn.Backend.services;

import Bamba.sn.Backend.entities.User;
import Bamba.sn.Backend.repositories.UserRepository;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class UserServiceImpl  implements  UserService{

    private final UserRepository userRepository;
    public UserServiceImpl(UserRepository userRepository) {
        this.userRepository = userRepository;
    }
    @Override
    public void createUser(User user) {

        this.userRepository.save(user);

    }

    @Override
    public void deleteUser(long id) {

    }

    @Override
    public List<User> getAllProduits() {
        return this.userRepository.findAll();
    }

    @Override
    public void updateClient(User user, long id) {

    }
}
