package com.example.api_immobilier.models;

import java.util.Set;

import org.springframework.lang.Nullable;

import jakarta.persistence.*;
import jakarta.persistence.Entity;
import jakarta.persistence.Table;
import lombok.Data;

@Entity
@Table(name = "users")
@Data
public class Users {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int userId;
    private String fullname;
    @Column(unique = true)
    private String email;
    // @Column(unique = true)
    // private String phone;
    @Nullable
    private String typeUser;
    @Nullable
    private String adress;

    @OneToMany
    Set<Inventaire> inventaires;
}
