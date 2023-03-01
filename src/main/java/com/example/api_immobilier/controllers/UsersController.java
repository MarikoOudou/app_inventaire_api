package com.example.api_immobilier.controllers;

import java.util.List;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.server.ResponseStatusException;
import org.springframework.http.HttpStatus;

import com.example.api_immobilier.models.ResponseData;
import com.example.api_immobilier.models.Users;
import com.example.api_immobilier.services.UsersServices;

import io.swagger.v3.oas.annotations.Operation;
import io.swagger.v3.oas.annotations.tags.Tag;

@CrossOrigin
@RestController
@Tag(name = "Users", description = "")
public class UsersController {

    @Autowired
    private UsersServices usersServices;

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
        result = usersServices.createOrUpdate(user);

        return result;
    }

    @Operation(summary = "Get User By Email")
    @PostMapping("/user/email")
    public ResponseData getUserByEmail(@RequestBody Users users) throws Exception {
        Object result = new Object();

        try {
            result = usersServices.findUsers(users.getEmail());
            System.out.println("--------------------------------------------------------------------");
            System.out.println(users.toString());
            System.out.println("--------------------------------------------------------------------");
            if (result == null) {
                return new ResponseData("L'utilisateur n'existe pas", false, result);
            }

            return new ResponseData("Récuperation des informations de l'utilisateur", true, result);
        } catch (Exception err) {
            // System.out.println(err.getMessage());
            throw new ResponseStatusException(HttpStatus.NOT_FOUND, err.getMessage(), err);
        }

    }

    @Operation(summary = "Update user")
    @PutMapping("/user/{users_id}")
    public Users update(@RequestBody Users user, @PathVariable Integer users_id) throws Exception {
        return usersServices.createOrUpdate(user);
    }

}
