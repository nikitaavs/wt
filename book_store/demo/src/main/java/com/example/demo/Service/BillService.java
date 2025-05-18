package com.example.demo.Service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.model.Bill;
import com.example.demo.repository.BillRepo;

@Service
public class BillService {
    @Autowired
    BillRepo objBillRepo;

    public double calculateBill(int units) {
        double amt = 0;
        if (units <= 50) {
            amt = units * 3.50;
        } else if (units <= 150) {
            amt = 50 * 3.50 + (units - 50) * 4.0;
        } else if (units <= 250) {
            amt = (50 * 3.50) + (100 * 4.0) + (units - 150) * 5.20;

        } else {
            amt = (50 * 3.50) + (100 * 4.0) + (100 * 5.20) + (units - 250) * 6.50;
        }
        return amt;
    }

    public List<Bill> getAllBill() {
        return objBillRepo.findAll();

    }

    public Bill getBillById(int id) {
        Bill bill = new Bill();
        bill.setId(0);
        bill.setName("Nik");
        bill.setAddress("abx");
        bill.setUnits_consumed(100);
        bill.setTotal_amt(0);
        return objBillRepo.findById(id).orElse(bill);
    }

    public Bill createBill(Bill bill) {
        double totalAmt = calculateBill(bill.getUnits_consumed());
        bill.setTotal_amt(totalAmt);
        return objBillRepo.save(bill);
    }

}
