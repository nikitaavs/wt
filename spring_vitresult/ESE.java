package com.example.demo.model;

import jakarta.persistence.Entity;
import jakarta.persistence.Id;

@Entity
public class ESE {
    @Id
    private int id;
    private int wt;
    private int daa;
    private int cyber;
    private int toc;

    public ESE() {
    }

    public ESE(int id, int wt, int daa, int cyber, int toc) {
        this.id = id;
        this.wt = wt;
        this.daa = daa;
        this.cyber = cyber;
        this.toc = toc;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getWt() {
        return wt;
    }

    public void setWt(int wt) {
        this.wt = wt;
    }

    public int getDaa() {
        return daa;
    }

    public void setDaa(int daa) {
        this.daa = daa;
    }

    public int getCyber() {
        return cyber;
    }

    public void setCyber(int cyber) {
        this.cyber = cyber;
    }

    public int getToc() {
        return toc;
    }

    public void setToc(int toc) {
        this.toc = toc;
    }

}
