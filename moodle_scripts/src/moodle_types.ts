

//this contains the interfaces for moodle objects 
//
//
//
//

export interface User{
  firstname:string,
  lastname:string,
  email:string,
  username:string,
  courses:string[]
  
}



export interface Teacher extends User{
  courses_taught:string[]
}



export interface Course{
  fullname:string,
  shortname:string //this is probably going to be the course_code 
  summary:string
  category:Category
}


export interface Category{
  name:string,
}

