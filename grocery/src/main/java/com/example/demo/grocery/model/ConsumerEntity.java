package com.example.demo.grocery.model;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;

@Entity
public class ConsumerEntity {
    @Id
    private int id ;
    private String name;
    private int itemsPurchased;

    
    public ConsumerEntity(int id, String name, int itemsPurchased) {
        this.id = id;
        this.name = name;
        this.itemsPurchased = itemsPurchased;
    }
    public ConsumerEntity() {
    }
    public int getId() {
        return id;
    }
    public void setId(int id) {
        this.id = id;
    }
    public String getName() {
        return name;
    }
    public void setName(String name) {
        this.name = name;
    }
    public int getItemsPurchased() {
        return itemsPurchased;
    }
    public void setItemsPurchased(int itemsPurchased) {
        this.itemsPurchased = itemsPurchased;
    }
    


}
