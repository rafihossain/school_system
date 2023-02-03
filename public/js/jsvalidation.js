$().ready(function () {
    $("#formDepartment").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            department_name: "required",
            description: "required",
            // department_image: "required",
            
            department_name: {
                required: true,
            },
            description: {
                required: true,
            },
            // department_image: {
            //     required: true,
            // },
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            department_name: "Department name field is required.", 
            description: "Description field is required.",
            // department_image: "Department image field is required.",
        }
    });
    $("#formDesignation").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            designation_name: "required", 
            designation_short_name: "required", 
            description: "required", 
            
            designation_name: {
                required: true,
            },
            designation_short_name: {
                required: true, 
            },
            description: {
                required: true, 
            },
      
             
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            designation_name: "Designation short name field is required.", 
            designation_short_name: "Designation short name field is required.",
            description: "Description name field is required.",
        }
    });
    $("#formSession").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            session_name: "required",
            start_date: "required",
            end_date: "required",
            
            session_name: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            session_name: "Session name field is required.", 
            start_date: "Start date field is required.", 
            end_date: "End date field is required.",
        }
    });
    $("#formClass").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            class_name: "required", 
            class_numeric: "required",
            
            class_name: {
                required: true,
            },
            class_numeric: {
                required: true, 
            }
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            class_name: "Class name field is required.", 
            class_numeric: "Class numeric field is required.", 
        }
    });
     $("#formSection").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            class_id: "required", 
            section_name: "required",
            section_capacity: "required",
            
            
            class_id: {
                required: true,
            },
            section_name: {
                required: true, 
            },
            section_capacity: {
                required: true,
            },
      
             
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            class_id: "Class name field is required.", 
            section_name: "Section name field is required.", 
            section_capacity: "Section capacity field is required.",
        }
    });
    $("#formClassroom").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            classroom_name: "required", 
            classroom_description: "required",
            
            classroom_name: {
                required: true,
            },
            classroom_description: {
                required: true,
            },
             
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            classroom_name: "Classroom name field is required.", 
            classroom_description: "Classroom description field is required.",
        }
    });
    $("#formSubject").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            section_id: "required",
            subject_name: "required",
            subject_code: "required",
            
            section_id: {
                required: true,
            },
            subject_name: {
                required: true,
            },
            subject_code: {
                required: true, 
            },

        },
        // in 'messages' user have to specify message as per rules
        messages: {
            section_id: "Section name field is required.", 
            subject_name: "Subject name field is required.", 
            subject_code: "Subject code field is required.",
        }
    });
    $("#formTeacherClass").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            class_id: "required", 
            section_id: "required", 
            teacher_id: "required", 
            
            
            class_id: {
                required: true,
            }, 
            section_id: {
                required: true,
            },
            teacher_id: {
                required: true,
            },
      
             
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            class_id: "Class name field is required.",  
            section_id: "Section name field is required.",
            teacher_id: "Teacher name field is required.",
           
        }
    });
    $("#formSyllabus").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            syllabus_title: "required", 
            class_id: "required",
            section_id: "required",
            subject_id: "required",
            
            
            syllabus_title: {
                required: true,
            },
            class_id: {
                required: true,
            },
            section_id: {
                required: true,
            },
            subject_id: {
                required: true,
            },
      
             
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            syllabus_title: "Syllabus title field is required.", 
            class_id: "Class name field is required.",
            section_id: "Section name field is required.",
            subject_id: "Subject name field is required.",
           
        }
    });
    
    $("#add_parent").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            name: "required",
            email: "required",
            password: "required",
            phone: "required",
            //gender: "required",
            
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            password: {
                required: true,
            },
            phone: {
                required: true,
            },
            // gender: {
            //     required: true,
            // }
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            department_name: "Name name field is required.", 
            description: "Email field is required.",
            password: "Password field is required.",
            phone: "Phone field is required.",
            //gender: "Gender image field is required.",
        }
    });

    $("#parent_additional_info_update").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            first_name: "required",
            last_name: "required",
            date_of_birth: "required",
            spouse_name: "required",
            spouse_occupation: "required",
            occupation: "required",
            whatsapp: "required",
            blood_group: "required",
            present_address: "required",
            office_address: "required",

        },
        // in 'messages' user have to specify message as per rules
        messages: {
            first_name: "First name name field is required.", 
            last_name: "Last name field is required.",
            date_of_birth: "Date Of Birth field is required.",
            spouse_name: "Spouse name field is required.",
            spouse_occupation:"Spouse occupation field is required.",
            occupation: "Occupation field is required.",
            whatsapp: "Whatsapp field is required.",
            blood_group: "Blood group field is required.",
            present_address: "Present address field is required.",
            office_address: "Office address field is required.",
        }
    });

    $("#parent_document_checklist_update").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            attested_passport_size_photograph: "required",
            attested_national_id_card: "required",
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            attested_passport_size_photograph: "Attested passport size photograph field is required.", 
            attested_national_id_card: "Attested national id card field is required.",
        }
    });


    $("#add_student").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            name: "required",
            email: "required",
            password: "required",
            parent_id: "required",
            class_id: "required",
            section_id: "required",
            roll_no: "required",
            admission_date: "required",
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            name: "Name field is required.", 
            email: "Email field is required.",
            password: "Password field is required.",
            parent_id: "Parent field is required.",
            class_id: "Class field is required.",
            section_id: "Section field is required.",
            roll_no: "Roll no field is required.",
            admission_date: "Admission date field is required.",
        }
    });

    $("#edit_student").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            first_name: "required",
            last_name: "required",
            date_of_birth: "required",
            // gender: "required",
            // b_form: "required",
            // registration: "required",
            // class_id: "required",
            // section_id: "required",
            father_name: "required",
            // father_occupation: "required",
            // father_cnic: "required",
            mother_name: "required",
            // mother_language: "required",
            // mother_occupation: "required",
            // guardian_name: "required",
            // guardian_office_address: "required",
            // guardian_office_phone: "required",
            // guardian_mobile_phone: "required",
            // guardian_mobile_whatsapp: "required",
            // guardian_mobile_email: "required",
        },
        // in 'messages' user have to specify message as per rules
        messages: {
            first_name: "First name field is required.", 
            last_name: "Last name field is required.",
            date_of_birth: "Date of birth field is required.",
            gender: "Gender field is required.",
            class_id: "Class field is required.",
            section_id: "Section field is required.",
            father_name: "Father field is required.",
            father_occupation: "Father occupation field is required.",
            father_cnic: "Father cnic field is required.",
            mother_name: "Mother name field is required.",
            mother_language: "Mother language field is required.",
            mother_occupation: "Mother occupation field is required.",
            guardian_name: "Guardian name field is required.",
            guardian_office_address: "Guardian office address field is required.",
            guardian_office_phone: "Guardian office phone field is required.",
            guardian_mobile_phone: "Guardian mobile phone field is required.",
            guardian_mobile_whatsapp: "Guardian mobile whatsapp field is required.",
            guardian_mobile_email: "Guardian email date field is required.",
      
        }
    });

    $("#student_additional_info_update").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            student_phone: "required",
            email: "required",

        },
        // in 'messages' user have to specify message as per rules
        messages: {
            student_phone: "Student phone field is required.", 
            email: "Email field is required.",
        }
    });

    $("#student_document_checklist_update").validate({
        // in 'rules' user have to specify all the constraints for respective fields
        rules: {
            attested_passport_size_photograph: "required",
            attested_national_id_card: "required",
            attested_all_certificate: "required",

        },
        // in 'messages' user have to specify message as per rules
        messages: {
            attested_passport_size_photograph: "Attested passport size photograph field is required.", 
            attested_national_id_card: "Attested national id card field is required.",
            attested_all_certificate: "Attested all certificate field is required.",
        }
    });
});