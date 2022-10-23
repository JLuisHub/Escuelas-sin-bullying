import { View, Text, FlatList, StyleSheet } from 'react-native'
import React, { Component } from 'react'
import ReportCard from '../components/ReportCard'
import {useNavigation} from '@react-navigation/native'

class ReportsList extends Component {
  constructor(props) {
    super(props)
  
    this.state = {
       data: []
    }
    //Este array en realidad va cargar los reportes traidos por una query
    this.arrayNew = [];
    this.getData()
  }

  getData = () => {

      fetch('http://192.168.1.117:8000/api/reportes/estudiante/' + this.props.id, {
          method: 'GET'
          //Request Type
      })
      .then((response) => response.json())
      //If response is in json then in success
      .then((response) => {
          //Success
          //const arrayTemp = []
          response.forEach(element => {
              tempSet = {
                  id: element['id'],
                  description: element['descripcion'],
                  date: element['fecha'],
              }
              this.arrayNew.push(tempSet)
              //console.log(this.arrayNew)
          })
          this.setState({data: this.arrayNew})
      })
      //If response is not in json then in error
      .catch((error) => {
          //Error 
          console.error(error)
      })
  }

  renderSeparator = () => {
      return (
          <View
          style={{
              height: 3,
              width: '100%',
              backgroundColor: '#3C4D6C',
          }}
          />
      );
  };

  renderHeader = () => {
    return (
      <View>
        <View style = {styles.headerInfoCont}>
              <Text style = {styles.headerInfoText} >
                  Numero de Reportes:     {this.arrayNew.length}
              </Text>
          </View>
      </View>
    )
  }

  render() {
    return (
      <View
        style={styles.containerView}>
          <FlatList
              style = {styles.list_cont}
              data={this.state.data}
              refreshing
              renderItem={({ item }) => (
                  <ReportCard id = {item.id} desc = {item.description} date = {item.date} />
              )}
              keyExtractor={item => item.id}
              ItemSeparatorComponent={this.renderSeparator}
              ListHeaderComponent={this.renderHeader}
          />
      </View>
    )
  }
}

const styles = StyleSheet.create({
  containerView: {
    padding: 20,
    width: '98%',
    alignSelf: 'center',
    justifyContent: 'center',
  },

  list_cont: {
    maxHeight: '100%'
  },
  headerInfoCont: {
    marginBottom: 10,
    padding: 10,
  },

  headerInfoText: {
    color: "black",
    fontSize: 40,
    fontWeight: 'bold',
  },

  button_cont: {
    width: '70%',
    maxHeight: 10,
    alignSelf: 'center'
  }
})

export default ReportsList