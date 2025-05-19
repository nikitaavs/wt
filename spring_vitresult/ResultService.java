package com.example.demo.Services;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.Repositories.ESERepo;
import com.example.demo.Repositories.MSERepo;
import com.example.demo.Repositories.StudentRepo;
import com.example.demo.model.ESE;
import com.example.demo.model.MSE;
import com.example.demo.model.Student;

@Service
public class ResultService {
    @Autowired
    StudentRepo studentRepo;

    @Autowired
    MSERepo mseRepo;

    @Autowired
    ESERepo eseRepo;

    // this is adding a new Student
    public Student AddStudent(Student student) {
        return studentRepo.save(student);
    }

    // method to get all student

    public List<Student> getAllStudent() {
        return studentRepo.findAll();
    }

    // method to calculate the result based on MSE and ESE marks
    public double calculateResult(MSE mse, ESE ese) {
        double wt_result = (mse.getWt() * 0.3) + (ese.getWt() * 0.7);
        double daa_result = (mse.getDaa() * 0.3) + (ese.getDaa() * 0.7);
        double cyber_result = (mse.getCyber() * 0.3) + (ese.getCyber() * 0.7);
        double toc_result = (mse.getToc() * 0.3) + (ese.getToc() * 0.7);

        double finalResult = (wt_result + daa_result + cyber_result + toc_result) / 4;
        return finalResult;
    }

    public MSE addMSEMarks(MSE mse) {
        return mseRepo.save(mse);
    }

    public ESE addESEMarks(ESE ese) {
        return eseRepo.save(ese);
    }

    public List<MSE> getAllMSE() {
        return mseRepo.findAll();
    }

    public List<ESE> getAllESE() {
        return eseRepo.findAll();
    }

    // getting the mse by id
    public MSE getMSEById(int id) {
        return mseRepo.findById(id).orElse(null);
    }
    // getting the ese by id

    public ESE getESEById(int id) {
        return eseRepo.findById(id).orElse(null);
    }

    // get student by id
    public Student getStudentById(int id) {
        return studentRepo.findById(id).orElse(null);
    }
}
