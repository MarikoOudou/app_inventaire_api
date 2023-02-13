package com.example.api_immobilier.app.services;

import org.springframework.stereotype.Service;

import com.example.api_immobilier.app.models.Users;
import com.example.api_immobilier.app.repositorys.UsersRepository;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;

@Service
public class UsersServices {

    @Autowired
    private UsersRepository usersRepository;

    public List<Users> getAll() {
        return usersRepository.findAll();
    }

    public Users getById(int id) {
        return usersRepository.findById(id).orElse(null);
    }

    public Users createOrUpdate(Users user) throws Exception {

        return usersRepository.save(user);
    }

    
    public Users findUsers(String email) throws Exception {

        return usersRepository.findByEmail(email);
    }

}
