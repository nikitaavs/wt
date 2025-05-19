package com.example.demo.grocery.model;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;

@Entity
public class itemEntity {
    @Id
    private int id;
    private String itemName;
    private int itemPrice;
    private String itemCategory;
    private int quantity;
    private double totalstockcost;

    
    public double getTotalstockcost() {
        return totalstockcost;
    }
    public void setTotalstockcost(double totalstockcost) {
        this.totalstockcost = totalstockcost;
    }
    public int getQuantity() {
        return quantity;
    }
    public void setQuantity(int quantity) {
        this.quantity = quantity;
    }
    public itemEntity(int id, String itemName, int itemPrice, String itemCategory,int quantity,double totalstockcost) {
        this.id = id;
        this.itemName = itemName;
        this.itemPrice = itemPrice;
        this.itemCategory = itemCategory;
        this.quantity=quantity;
        this.totalstockcost=totalstockcost;
        
    }
    public itemEntity() {
    }
    public int getId() {
        return id;
    }
    public void setId(int id) {
        this.id = id;
    }
    public String getItemName() {
        return itemName;
    }
    public void setItemName(String itemName) {
        this.itemName = itemName;
    }
    public int getItemPrice() {
        return itemPrice;
    }
    public void setItemPrice(int itemPrice) {
        this.itemPrice = itemPrice;
    }
    public String getItemCategory() {
        return itemCategory;
    }
    public void setItemCategory(String itemCategory) {
        this.itemCategory = itemCategory;
    }
    


}
