import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})

@Injectable({
  providedIn: 'root'
})
export class MainComponent implements OnInit {
  
  expresionN = /^[A-Za-z\s]+$/;
	expresionC = /\w+@\w+\.+[a-z]/;
  public formLogin = new FormGroup({});
  readonly endpoint:string = 'http://localhost:80/APIopenweatherapp/registrar/registrar-user.php';

  constructor(private formBuilder: FormBuilder,private http: HttpClient) {}

  ngOnInit(): void {
    this.formLogin = this.formBuilder.group({
      name: ['',Validators.required],
      user: ['',Validators.required],
      email: ['',[Validators.required,Validators.email,]],
      pass: ['',Validators.required]
    });
  }

  send():any{

    if(this.formLogin.valid){
      fetch(this.endpoint,{
        method: 'POST',
        body: JSON.stringify(this.formLogin.value)
      }).then(res=>res.json());
      alert("El usuario se ha creado correctamente, redirigiendo al inicio");
      setInterval(function(){
        location.href="http://localhost:4200/login";
      },2000);
      
    }else{
      alert("Por favor, ingrese los datos correctos");
    }
  }
}
