package com.example.api_immobilier.app.repositorys;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.api_immobilier.app.models.Users;

public interface UsersRepository extends JpaRepository<Users, Integer> {

}
