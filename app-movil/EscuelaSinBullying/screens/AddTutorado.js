import { View, Text, StyleSheet, Alert } from 'react-native'
import React, {useState} from 'react'

import CustomInput from '../components/CustomInput'
import CustomButton from '../components/CustomButton'

import {useNavigation} from '@react-navigation/native'

const AddTutorado = () => {
    const [clave, setClave] = useState('');
    const [matricula, setMatricula] = useState('');
    const [fecha, setFecha] = useState('');

    const navigation = useNavigation()

    const onSavePress = () => {
        /*if (accesos[email]) {
            if (accesos[email] == password) {
                console.info("Sesion iniciada")
                navigation.navigate("ProfessorsHome")
            } else{
                console.error("Email o Contraseña incorrectos")
            }
        } else {
            console.error("Email o Contraseña incorrectos")
        }*/
        console.log(clave)
        console.log(matricula)
        console.log(fecha)
        
        //InsertRecord()
        //tryAPI()
    }

    tryAPI = () => {
        fetch('http://192.168.1.131:8000/allEstudiantes', {
            method: 'GET'
            //Request Type 
        })
        .then((response) => response.json())
        //If response is in json then in success
        .then((response) => {
            //Success 

            console.log(response)
        })
        //If response is not in json then in error
        .catch((error) => {
            //Error 
            console.error(error);
        });
    }

    InsertRecord=()=>{
        var Email = email;
        var Password = password;
    
        if ((Email.length==0) || (Password.length==0)){
          alert("Required Field Is Missing!!!");
        }else{
          var APIURL = "http://127.0.0.1:8000/docs";
    
          var headers = {
            'Accept' : 'application/json',
            'Content-Type' : 'application/json'
          };
                
          var Data ={
            Email: Email,
            Password: Password
          };
    
          fetch(APIURL,{
            method: 'POST',
            headers: headers,
            body: JSON.stringify(Data)
          })
          .then((Response)=>Response.json())
          .then((Response)=>{
            alert(Response[0].Message)
            if (Response[0].Message == "Success") {
              console.log("true")
              this.props.navigation.navigate("Lista de Alumnos");
            }
            console.log(Data);
          })
          .catch((error)=>{
            console.error("ERROR FOUND" + error);
          })
        }
    }

  return (
    <View>
        <View style = {[styles.login_form_cont]}>

            <Text style = {[styles.login_input_name]}>Clave de la escuela</Text>
            <CustomInput 
                placeholder = "Introduzca la clave"
                value = {clave}
                setValue = {setClave}
                />
            
            <Text style = {[styles.login_input_name]}>Matricula</Text>
            <CustomInput 
                placeholder = "Introduzca la matricula"
                value = {matricula}
                setValue = {setMatricula}
                />

            <Text style = {[styles.login_input_name]}>Fecha de nacimiento sin guiones</Text>
            <CustomInput 
                placeholder = "ejemplo 22-10-22 sería 221022"
                value = {fecha}
                setValue = {setFecha}
                />

            <View style = {[styles.CustomButtonCont]}>
                <CustomButton
                    text = 'Agregar'
                    onPress = {onSavePress}
                    />
            </View>
        </View>
    </View>
  )
}

const styles = StyleSheet.create({
    login_form_cont: {
        width: '80%',
        alignSelf: "center",
        marginTop: "30%"
    },  

    login_input_name: {
        color: 'black',
        fontSize: 20,
        fontWeight: "bold",
        alignSelf: "center",
        marginBottom: 20
    },

    CustomButtonCont: {
        marginTop: 30,
        width: "70%",
        maxHeight: 60,
        alignSelf: 'center'
    }

})

export default AddTutorado