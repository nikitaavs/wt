package com.example.demo.grocery.services;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.grocery.Repository.ItemRepository;
import com.example.demo.grocery.model.itemEntity;

@Service
public class itemServices {

    @Autowired
    ItemRepository itemRepository;

    public void additem(itemEntity itemEntity)
    {
        itemRepository.save(itemEntity);
    }
    public itemEntity getItembyId(int id)
    {
        itemEntity item=new itemEntity();
        item.setId(0);
        item.setItemName("item");
        item.setItemPrice(0);
        item.setItemCategory("unknown");
        item.setQuantity(0);
        return itemRepository.findById(id).orElse(item);
    }
    public List<itemEntity>getallitems()
    {
        return itemRepository.findAll();
    }

    public double total(int price,int qty)
    {
        
       double bill=price*qty;
       return bill;
    }
    public void calculatetotal(itemEntity itemEntity)
    {
        double result=total(itemEntity.getItemPrice(),itemEntity.getQuantity());
        itemEntity.setTotalstockcost(result);
        itemRepository.save(itemEntity);
    
    }


}
