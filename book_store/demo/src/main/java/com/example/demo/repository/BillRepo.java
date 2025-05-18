package com.example.demo.repository;

import org.springframework.data.jpa.repository.JpaRepository;

import com.example.demo.model.Bill;

public interface BillRepo extends JpaRepository<Bill, Integer> {

}
