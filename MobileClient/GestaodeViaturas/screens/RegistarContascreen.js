import React, { Component } from "react";
import { Input } from 'react-native-elements';
import FontAwesomeIcons from 'react-native-vector-icons/FontAwesome';
import { StyleSheet, Text, View, TextInput, TouchableOpacity, Image, Alert } from "react-native";
import { SafeAreaView } from "react-native-safe-area-context";

updateNome = () => {
    const { nome } = state;
    setState({
        nome: text
    });
};

updateNrmeca = () => {
    const { nrmeca } = state;
    setState({
        nrmeca: text
    });
};

updateEmail = () => {
    const { email } = state;
    setState({
        email: text
    });
};

updatePassword = () => {
    const { password } = state;
    setState({
        password: text
    });
};

export default RegistarContaScreen = ({ navigation }) => {

    return (
        <SafeAreaView style={styles.container}>
        <View style={styles.inputView} >
          <Input
            placeholder=' Nome...'
            leftIcon={
              <FontAwesomeIcons
                name='user'
                size={24}
                color='#810053'
              />
            }
          />
          <Input
            placeholder=' Número Mecanográfico'
            secureTextEntry={true}
            leftIcon={
              <FontAwesomeIcons
                name='key'
                size={18}
                color='#810053'
              />
            }
          />
          <Input
            placeholder=' E-Mail'
            leftIcon={
                <FontAwesomeIcons
                name='send'
                size={18}
                color='#810053'
                />
            }
          />
          <Input
            placeholder=' Password'
            leftIcon={
                <FontAwesomeIcons
                name='key'
                size={18}
                color='#810053'
                />
            }
          />
        </View>
        <View style={styles.containerBtn}>
          <TouchableOpacity style={styles.registarBtn} onPress={() => navigation.navigate("App")}>
            <Text style={styles.registarTextbtn}>Registar</Text>
          </TouchableOpacity>
        </View>
        </SafeAreaView>
    );
  };

// #810053
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: 'white',
    alignItems: 'center',
    justifyContent: 'center',
    flexShrink: 2,
  },

  containerBtn: {
    flex: 1,
    justifyContent: "center",
    alignItems: 'center',   
  },

  inputView: {
    width: "80%",
    backgroundColor: "white",
    borderRadius: 10,
    alignItems: 'center',
    marginTop: 50,
    padding: 5,
    flex: 1,
    justifyContent: 'space-evenly'
  },

  inputText: {
    height: 50,
    color: "black"
  },

  registarBtn: {
    width: 200,
    backgroundColor: "#810053",
    borderRadius: 25,
    height: 50,
    alignItems: "center",
    justifyContent: "center",
    marginBottom: 10,

  },

  registarTextbtn: {
    fontSize: 20,
    color: "white",
  },
});