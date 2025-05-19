package com.example.demo.Controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

import com.example.demo.Services.ResultService;
import com.example.demo.model.ESE;
import com.example.demo.model.MSE;
import com.example.demo.model.Student;

import jakarta.websocket.server.PathParam;

import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestParam;

@RestController
public class ResultController {

    @Autowired
    ResultService resultService;

    // add a new Student
    @PostMapping("/addStudent")
    public Student addStudent(@RequestBody Student student) {
        return resultService.AddStudent(student);

    }

    @CrossOrigin(origins = "http://localhost:3001") // allow only this origin
    @GetMapping("/getAllStudents")
    public List<Student> getAllStudents() {
        return resultService.getAllStudent();
    }

    @PostMapping("/addMSEMarks")
    public MSE addMSEMarks(@RequestBody MSE mse) {
        return resultService.addMSEMarks(mse);
    }

    @PostMapping("/addESEMarks")
    public ESE addESEMarks(@RequestBody ESE ese) {
        return resultService.addESEMarks(ese);
    }

    @PostMapping("/calculateResult/{id}")
    public String calculateFinalResult(@PathVariable int id) {
        MSE mse = resultService.getMSEById(id);
        if (mse == null) {
            return "MSE marks not found for the given student id";
        }
        ESE ese = resultService.getESEById(id);
        if (ese == null) {
            return "ESE marks for the given student not found";
        }
        double finalResult = resultService.calculateResult(mse, ese);
        Student student = resultService.getStudentById(id);
        if (student == null) {
            return "No student found";
        }
        student.setResult(finalResult);
        resultService.AddStudent(student);
        return "Final result updated successfully! Result: " + finalResult;

    }

}
