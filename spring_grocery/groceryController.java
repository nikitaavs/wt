package com.example.demo.grocery.controllers;

import org.springframework.web.bind.annotation.RestController;

import com.example.demo.grocery.model.ConsumerEntity;
import com.example.demo.grocery.model.itemEntity;
import com.example.demo.grocery.services.ConsumerServices;
import com.example.demo.grocery.services.itemServices;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;

import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;



@RestController
@CrossOrigin(origins = "http://localhost:3000")
public class groceryController {

    @Autowired
    itemServices itemServices;

    @Autowired
    ConsumerServices consumerServices;

    @GetMapping("/allitems")
    public List<itemEntity>getAllItems(){
        return itemServices.getallitems();
    }
    @GetMapping("/item/{id}")
    public itemEntity getitembyID(@PathVariable int id)
    {
        return itemServices.getItembyId(id);
    }
    @PostMapping("/additem")
    public void addItemEntity(@RequestBody itemEntity itemEntity)
    {
        itemServices.additem(itemEntity);
    }
    @PostMapping("/calculateitem")
    public void calculateTotal(@RequestBody itemEntity itemEntity)
    {
        itemServices.calculatetotal(itemEntity);
    }
    @PostMapping("/addConsumer")
    public void addCustomer(@RequestBody ConsumerEntity consumerEntity)
    {
        consumerServices.addConsumerEntity(consumerEntity);
    }
    @GetMapping("/getconsumers")
    public List<ConsumerEntity> getConsumers()
    {
        return consumerServices.getallconsumers();
    }
    @GetMapping("/consumer/{id}")
    public ConsumerEntity getconsumerByid(@PathVariable int id)
    {
        return consumerServices.getconsumerByid(id);
    }

    
    
    
    
    
    


    

}
