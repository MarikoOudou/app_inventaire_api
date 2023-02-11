package com.example.api_immobilier.app.controllers;

import java.util.Collections;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.example.api_immobilier.app.models.Users;
import com.example.api_immobilier.app.services.UsersServices;

import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.tags.Tag;

@CrossOrigin
@RestController
@Tag(name = "Users", description = "")
public class UsersController {

    @Autowired
    private UsersServices usersServices;

    // @GetMapping("/")
    // public Map<String, Object> greeting() {
    // return Collections.singletonMap("message", "Hello, World");
    // }
    @Operation(summary = "Get All user")
    @GetMapping("/users")
    public List<Users> getAll() {
        return usersServices.getAll();
    }

    @Operation(summary = "Get user by id")
    @GetMapping("/user/{users_id}")
    public Users getById(@PathVariable int users_id) {
        return usersServices.getById(users_id);
    }

    @Operation(summary = "Create user")
    @PostMapping("/user")
    public Object create(@RequestBody Users user) throws Exception {
        Object result = new Object();
        // if (Integer.parseInt(user.getTypeUser()) == 0 ||
        // Integer.parseInt(user.getTypeUser()) == 1) {
        // result = usersServices.createOrUpdate(user);
        // } else {
        // result = Collections.singletonMap("message", "le type d'utilisateur n'existe
        // pas");
        // }

        result = usersServices.createOrUpdate(user);

        return result;
    }

    @Operation(summary = "Update user")
    @PutMapping("/user/{users_id}")
    public Users update(@RequestBody Users user, @PathVariable Integer users_id) throws Exception {
        return usersServices.createOrUpdate(user);
    }

}
