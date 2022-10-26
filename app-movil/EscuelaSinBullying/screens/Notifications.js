import { View, Text, StyleSheet } from 'react-native'
import React from 'react'
import SearchFunction from '../components/SearchFunction'
import NotificationsList from '../components/NotificactionsList'

const Notifications = ({route, navigation}) => {
    const {id} = route.params

    return (
        <View style={styles.lists_cont}>
            <View style={styles.list_cont}>
                <NotificationsList id={id} tipo= {'Reporte'}/>
            </View>
            <View style={styles.list_cont}>
                <NotificationsList id={id} tipo= {'Citatorio'}/>
            </View>
        </View>
    )
}

const styles = StyleSheet.create({
    lists_cont: {
        display: 'flex',
        flexDirection: 'column',
    },

    list_cont: {
        flex: 1,
    }
})

export default Notifications