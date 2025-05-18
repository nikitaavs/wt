package com.example.demo.Controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.Service.BillService;
import com.example.demo.model.Bill;

@RestController
public class BillController {
    @Autowired
    BillService bill_service;

    @GetMapping("/allBills")
    public List<Bill> getABills() {
        return bill_service.getAllBill();
    }

    @GetMapping("/bill/{id}")
    public Bill getBillById(@PathVariable int id) {
        return bill_service.getBillById(id);
    }

    @PostMapping("/billAdd")
    public void AddBill(@RequestBody Bill bill) {
        bill_service.createBill(bill);
    }

}
