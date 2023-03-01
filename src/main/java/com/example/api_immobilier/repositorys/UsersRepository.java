package com.example.api_immobilier.repositorys;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.api_immobilier.models.Users;

public interface UsersRepository extends JpaRepository<Users, Integer> {
    Users findByEmail(String email);
}
