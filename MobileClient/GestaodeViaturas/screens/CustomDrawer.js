import React, {Component, useState} from 'react';
import { View, StyleSheet, AsyncStorage } from 'react-native';
import {
    Avatar,
    Title,
    Caption,
    Paragraph,
    Drawer,
    Text,
    TouchableRipple,
    Switch
} from 'react-native-paper';
import {
    DrawerContentScrollView,
    DrawerItem
} from '@react-navigation/drawer';

import Icon from 'react-native-vector-icons/MaterialCommunityIcons';

export function DrawerContent(props) {

    const [nome, setNome] = useState(0);

    const [apelido, setApelido] = useState(0);

    const [roleDescription, setRoleDescription] = useState(0);

    const { navigate } = props.navigation;

    const getNome = async()=> {
      try {
        const nome = await AsyncStorage.getItem("nome");
        console.log(nome);
        setNome(nome);
      }
      catch (exception) {
      }
    };

    const getApelido = async()=> {
      try {
        const apelido = await AsyncStorage.getItem("apelido");
        console.log(apelido);
        setApelido(apelido);
      }
      catch (exception) {
      }
    };

    const getRoleDescription = async()=> {
      try {
        const roleDescription = await AsyncStorage.getItem("roleDescription");
        console.log(roleDescription);
        setRoleDescription(roleDescription);
      }
      catch (exception) {
      }
    };

    getNome();
    getApelido();
    getRoleDescription();

    const removeToken = async()=> {
      try {
          await AsyncStorage.removeItem("token");
      }
      catch(exception) {
          return false;
      }
  };
    const removeRole = async()=> {
      try {
          await AsyncStorage.removeItem("role");
      }
      catch(exception) {
          return false;
      }
  };

    const removeNome = async()=> {
      try {
          await AsyncStorage.removeItem("nome");
      }
      catch(exception) {
          return false;
      }
  };

    const removeApelido = async()=> {
      try {
          await AsyncStorage.removeItem("apelido");
      }
      catch(exception) {
          return false;
      }
  };

    const removeRoleDescription = async()=> {
      try {
          await AsyncStorage.removeItem("roleDescription");
      }
      catch(exception) {
          return false;
      }
  };
      
      const logoutFunction = async () => {

        const token = await AsyncStorage.getItem("token");
        const role = await AsyncStorage.getItem("role");

        fetch(
          "http://192.168.1.113/grupo4-pws/web/user-management/auth/logout",
          {
            method: "GET",
            headers: {
              Accept: "application/json",
              "Content-Type": "application/json",
              },
          })
          .then((response) => {
            removeToken();
            removeRole();
            removeNome();
            removeApelido();
            removeRoleDescription();
            props.navigation.navigate("Auth");
          })
          .catch((error) => {
            console.log(error)
          }
        );
    }
    return(
        <View style={{flex:1}}>
            <DrawerContentScrollView {...props}>
                <View style={styles.drawerContent}>
                    <View style={styles.userInfoSection}>
                        <Drawer.Section style={styles.drawerSection}>
                        <View style={{flexDirection:'row',marginTop: 15}}>
                            <Avatar.Image 
                                source={require('../assets/babyyoda.png')}
                                size={50}
                            />
                            <View style={{marginLeft:15, flexDirection:'column'}}>
                                <Title style={styles.title}>{nome} {apelido}</Title>
                                <Caption style={styles.caption}>{roleDescription}</Caption>
                            </View>
                        </View>
                        </Drawer.Section>
                    </View>

                    <Drawer.Section style={styles.drawermidSection}>
                        <DrawerItem 
                            icon={({color, size}) => (
                                <Icon 
                                name="home-outline" 
                                color={"#810053"}
                                size={size}
                                />
                            )}
                            label="Página Inicial"
                            inactiveTintColor="#810053"
                            onPress={() => {props.navigation.navigate('Home')}}
                        />
                        <DrawerItem 
                            icon={({color, size}) => (
                                <Icon 
                                name="account-outline" 
                                color={"#810053"}
                                size={size}
                                />
                            )}
                            label="Histórico"
                            inactiveTintColor="#810053"
                            onPress={() => {props.navigation.navigate('Historico')}}
                        />
                        <DrawerItem
                            icon={({color, size}) => (
                                <Icon 
                                name="bookmark-outline" 
                                color={"#810053"}
                                size={size}
                                />
                            )}
                            label="Perfil"
                            inactiveTintColor="#810053"
                            onPress={() => {props.navigation.navigate('Perfil')}}
                        />
                    </Drawer.Section>
                </View>
            </DrawerContentScrollView>
            <Drawer.Section style={styles.bottomDrawerSection}>
                <DrawerItem 
                    icon={({color, size}) => (
                        <Icon 
                        name="exit-to-app" 
                        color={color}
                        size={size}
                        />
                    )}
                    label="Sair"
                    inactiveTintColor="#810053"
                    onPress={() => {logoutFunction()}}
                />
            </Drawer.Section>
        </View>
    );
}

const styles = StyleSheet.create({
    drawerContent: {
      flex: 1,
    },
    userInfoSection: {
      paddingLeft: 20,
    },
    title: {
      fontSize: 16,
      marginTop: 3,
      fontWeight: 'bold',
    },
    caption: {
      fontSize: 14,
      lineHeight: 14,
    },
    row: {
      marginTop: 20,
      flexDirection: 'row',
      alignItems: 'center',
    },
    section: {
      flexDirection: 'row',
      alignItems: 'center',
      marginRight: 15,
    },
    paragraph: {
      fontWeight: 'bold',
      marginRight: 3,
    },
    drawertopSection: {
      marginTop: 15,
    },
    drawermidSection: {
        marginTop: 30,
      },
    bottomDrawerSection: {
        marginBottom: 15,
        borderTopColor: '#f4f4f4',
        borderTopWidth: 1
    },
    preference: {
      flexDirection: 'row',
      justifyContent: 'space-between',
      paddingVertical: 12,
      paddingHorizontal: 16,
    },
  });