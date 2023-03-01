package com.example.api_immobilier.models;

import java.util.Set;

import org.springframework.lang.Nullable;

import jakarta.persistence.*;
import jakarta.persistence.Entity;
import jakarta.persistence.Table;

@Entity
@Table(name = "users")
public class Users {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private int userId;
    private String Fullname;
    @Column(unique = true)
    private String email;
    @Column(unique = true)
    private String phone;

    @Nullable
    private String typeUser;
    // private String password;
    @Nullable
    private String adress;

    @OneToMany
    Set<Inventaire> inventaires;

    public Users() {
    }

    public Users(int userId, String fullname, String email, String typeUser, String adress) {
        this.userId = userId;
        Fullname = fullname;
        this.email = email;
        this.typeUser = typeUser;
        this.adress = adress;
    }

    public int getUserId() {
        return userId;
    }

    public void setUserId(int userId) {
        this.userId = userId;
    }

    public String getFullname() {
        return Fullname;
    }

    public void setFullname(String fullname) {
        Fullname = fullname;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getTypeUser() {
        return typeUser;
    }

    public void setTypeUser(String typeUser) {
        this.typeUser = typeUser;
    }

    public String getAdress() {
        return adress;
    }

    public void setAdress(String adress) {
        this.adress = adress;
    }

}
