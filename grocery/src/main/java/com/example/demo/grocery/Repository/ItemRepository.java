package com.example.demo.grocery.Repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.example.demo.grocery.model.itemEntity;

@Repository
public interface ItemRepository  extends JpaRepository<itemEntity,Integer>{

    
} 
