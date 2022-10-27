import { View, Text, TextInput, StyleSheet, ScrollView } from 'react-native'
import React, {useState} from 'react'
import DatePicker from 'react-native-date-picker'
import CustomButton from '../components/CustomButton'
import {useNavigation} from '@react-navigation/native'

function Summon ({ route, navigation }) {
    // id, nombre y matricula del alumno pasada por parametros
    const { id, nombre, matricula } = route.params
    const [descripcion, setDescripcion] = useState('')
    const [date, setDate] = useState(new Date())

    const onSendPress = () => {
        // Aqui va query para agregar el citatorio a la tabla Citatorios
        console.log("El citatorio lleva la siguiente info")
        console.log(id)
        console.log(matricula)
        console.log(descripcion)
        console.log(date)

        navigation.goBack()

    }
    

  return (
    <ScrollView style = {styles.mainCont}>
      <View style = {styles.doubleColumn}>
        <Text style = {styles.title}>Citatorio para tutor de: </Text>
        <Text style = {styles.title} >{nombre}</Text>
      </View>
      <View style = {styles.doubleColumn} >
        <View style = {styles.subCont}>
            <Text style = {styles.title} >Matricula: </Text>
            <Text style = {styles.infoText}>{matricula}</Text>
        </View>
        <View style = {styles.subCont} >
            <Text style = {styles.title} >Fecha de Cita: </Text>
            <DatePicker mode='datetime' date={date} onDateChange={setDate} />
        </View>
      </View>

      <View style = {styles.textInputCont} >
        <Text style = {styles.title} >Descripción</Text>
        <TextInput 
            style = {styles.textInput}
            placeholder = "Descripcion"
            defaultValue = {descripcion}
            onChangeText = {newDesc => setDescripcion(newDesc)}
            multiline = {true}
            />
      </View>

      <View style = {styles.contButton}>
        <CustomButton 
            text = 'Enviar'
            onPress = {onSendPress} />
      </View>
    </ScrollView>
  )
}

const styles = StyleSheet.create({
    mainCont: {
        paddingHorizontal: 10
    },
    doubleColumn: {
        //flexDirection: 'row',
        justifyContent: 'center',
        marginVertical: 30,
    },
    subCont: {
        flex: 1,
        alignItems:'center',
    },
    title: {
        fontSize: 20,
        fontWeight: 'bold',
        marginVertical: 10,
        alignSelf:'center'
    },

    infoText: {
        fontSize: 15,
        justifyContent:'center',
        textAlignVertical: 'center'
    },
    textInputCont: {
        marginVertical: 30,
    },
    textInput: {
        minHeight: 100,
        backgroundColor: "white",
        textAlignVertical: 'top',
        padding: 10,
    },
    contButton: {
        maxHeight: 70,
    }
})

export default Summon