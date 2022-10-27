import { View, Text, FlatList, StyleSheet } from 'react-native'
import React, {useState} from 'react'
import ReportsList from '../components/ReportsList'
import CustomButton from '../components/CustomButton'

const ReportsRecord = ({route, navigation}) => {
    const {id, matricula, nombre} = route.params

    onPressAddReport = () => {
    
        navigation.navigate('Report', {id: id, nombre: nombre, matricula: matricula})
    }

    onPressAddSummon = () => {
    
      navigation.navigate('Summon', {id: id, nombre: nombre, matricula: matricula})
    }

    return (
        <View>
          <View>
              <ReportsList id = {id} matricula = {matricula} nombre = {nombre} nav={navigation}/>
          </View>
          <View style={styles.buttons_cont}>
            <View style = {styles.button_cont}>
              <CustomButton text = "Nuevo Reporte" onPress = {this.onPressAddReport} />
            </View>
            <View style = {styles.button_cont}>
              <CustomButton text = "Nuevo Citatorio" onPress = {this.onPressAddSummon} />
            </View>
          </View>

        </View>
    );
}

const styles = StyleSheet.create({
    button_cont: {
      maxHeight: 60,
      alignSelf: 'center',
      flex: 1,
    },

    buttons_cont: {
      marginTop: 1,
      alignSelf:'center',
      width: '85%',
      display: 'flex',
      flexDirection: 'row',
    }
  })

export default ReportsRecord