import { View, Text, FlatList, StyleSheet } from 'react-native'
import React, {useState} from 'react'
import ReportsList from '../components/ReportsList'
import CustomButton from '../components/CustomButton'

const ReportHistory = ({route, navigation}) => {
    const {id, matricula, nombre} = route.params

    onPressAddReport = () => {
    
        navigation.navigate('Report', {nombre: nombre, matricula: matricula})
    }

    return (
        <View>
            <View>
                <ReportsList id = {id} matricula = {matricula} nombre = {nombre}/>
            </View>
            <View style = {styles.button_cont}>
              <CustomButton text = "Nuevo Reporte" onPress = {this.onPressAddReport} />
          </View>
        </View>
    );
}

const styles = StyleSheet.create({
    button_cont: {
      width: '70%',
      maxHeight: 60,
      alignSelf: 'center'
    }
  })

export default ReportHistory