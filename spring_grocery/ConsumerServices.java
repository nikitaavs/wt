package com.example.demo.grocery.services;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.grocery.Repository.ConsumerRepository;
import com.example.demo.grocery.model.ConsumerEntity;

@Service
public class ConsumerServices {
    @Autowired
    ConsumerRepository consumerRepository;

    public void addConsumerEntity(ConsumerEntity consumerEntity)
    {
        consumerRepository.save(consumerEntity);
    } 
    public ConsumerEntity getconsumerByid(int id)
    {
        ConsumerEntity consumerEntity=new ConsumerEntity();
        consumerEntity.setId(0);
        consumerEntity.setItemsPurchased(5);
        consumerEntity.setName("uknown");
        return consumerRepository.findById(id).orElse(consumerEntity);

    }

    public List<ConsumerEntity>getallconsumers()
    {
        return consumerRepository.findAll();
    }

}
