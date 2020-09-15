package com.dochart;

import lombok.Data;

import javax.persistence.*;

@Data
@Entity
public class Patient {

    @Id
    @GeneratedValue(strategy= GenerationType.SEQUENCE)
    @SequenceGenerator(name="Patient_SEQ", allocationSize= 10000)
    private Integer id;
    private int age;
    private int height;
    private int weight;
    private String fname;
    private String lname;
    private String medications;
    private String bloodType;
    private String insurance;


}//Class Patient
