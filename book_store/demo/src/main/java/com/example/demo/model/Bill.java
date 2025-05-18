package com.example.demo.model;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;

@Entity
public class Bill {
    @Id
    private int id;
    private String name;
    private String address;
    private int units_consumed;
    private double total_amt;

    public Bill() {
    }

    public Bill(int id, String name, String address, int units_consumed, double total_amt) {
        this.id = id;
        this.name = name;
        this.address = address;
        this.units_consumed = units_consumed;
        this.total_amt = total_amt;
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

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public int getUnits_consumed() {
        return units_consumed;
    }

    public void setUnits_consumed(int units_consumed) {
        this.units_consumed = units_consumed;
    }

    public double getTotal_amt() {
        return total_amt;
    }

    public void setTotal_amt(double total_amt) {
        this.total_amt = total_amt;
    }

}
