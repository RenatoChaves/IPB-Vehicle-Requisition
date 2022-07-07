import React, { Component } from "react";
import { StyleSheet, Text, View, TextInput, TouchableOpacity, Image, Alert, StatusBar, Platform, AsyncStorage, TouchableNativeFeedbackBase} from "react-native";
import FontAwesomeIcons from 'react-native-vector-icons/FontAwesome';
import { Input, ThemeConsumer } from 'react-native-elements';
import base64 from 'react-native-base64';

// import Constants from "expo-constants";

export default class LoginScreen extends React.Component {
    state = {
      loading: false,
      username: "",
      password: "",
      isLoaded: false,
    };

  storeToken = async (token) => {
    try {
      AsyncStorage.setItem("token",token);
      console.log(token);
    }
    catch (error) {
      //guardar erro
    }
  };

  storeRole = async (role) => {
    try {
      AsyncStorage.setItem("role",role);
    }
    catch (error) {
    }
  };

  storeRoleDescription = async (roleDescription) => {
    try {
      AsyncStorage.setItem("roleDescription",roleDescription);
    }
    catch (error) {
    }
  };

  storeNome = async (nome) => {
    try {
      AsyncStorage.setItem("nome", nome);
    }
    catch (error) {
    }
  };

  storeApelido = async (apelido) => {
    try {
      AsyncStorage.setItem("apelido", apelido);
    }
    catch (error) {
    }
  };

  storeEmail = async (email) => {
    try {
      AsyncStorage.setItem("email", email);
    }
    catch (error){
    }
  };

  storeNumeroMecanografico = async (numeroMecanografico) => {
    try {
      AsyncStorage.setItem("numeroMecanografico", numeroMecanografico);
    }
    catch (error){
    }
  };

  storeNumeroBI = async (numeroBI) => {
    try {
      AsyncStorage.setItem("numeroBI", numeroBI);
    }
    catch (error){
    }
  };

  getToken = async () => {
    const token = await AsyncStorage.getItem("token");
    console.log(token);
  }

  getRole = async () => {
    const role = await AsyncStorage.getItem("role");
    console.log(role);
  }

  loginFunction(){
    
    console.log("login")
    if(this.state.username && this.state.password) {

      this.setState({
        loading: true
      })
  
      fetch(
        "http://192.168.1.113/grupo4-pws/web/api-v1/auth",
        {
          method: "GET",
          headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
            Authorization:
              "Basic " +
              base64.encode(this.state.username + ":" + this.state.password),
          },
        })
        .then((response) => response.json())
        .then((responseJson) => {       
          this.setState({
            loading: false
          })
          console.log("teste novo login ",responseJson)
          this.storeToken(responseJson.accessToken)
          console.log(responseJson[0].email)
          this.storeEmail(responseJson[0].email)
           if(responseJson.accessToken != null){
            fetch(
              "http://192.168.1.113/grupo4-pws/web/api-v1/auth/roles",
              {
                method: "GET",
                headers: {
                  Accept: "application/json",
                  "Content-Type": "application/json",
                  Authorization:
                  "Basic " +
                  base64.encode(responseJson.accessToken + ":"),
                },
              })
              .then((response) => response.json())
              .then((responseJson) => {
                console.log("antes de guardar");
                this.storeRole(responseJson[0].name)
                this.storeRoleDescription(responseJson[0].description)
                this.state.isLoaded = true
                console.log("guardou",responseJson[0].name)
                console.log("guardou",responseJson[0].description)

                if(this.state.isLoaded == true) {

                  fetch(
                    "http://192.168.1.113/grupo4-pws/web/api-v1/auth/dados",
                    {
                      method: "GET",
                      headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        Authorization:
                        "Basic " +
                        base64.encode(responseJson.accessToken + ":"),
                      },
                    })
                    .then((response) => response.json())
                    .then((responseJson) => {
                      this.storeNome(responseJson[0].nome)
                      this.storeApelido(responseJson[0].apelido)
                      this.storeNumeroMecanografico(responseJson[0].numeroMecanografico)
                      this.storeNumeroBI(responseJson[0].numeroBI)
                    })
                  this.props.navigation.navigate(responseJson[0].name);
                  console.log("entrou");
                }
                else {
                  this.props.navigation.navigate("Auth");
              }
              })
              .catch((error) => {
                console.log(error)
              }
            )
          }
          else{
            alert("Wrong username or password");
          }
        })
        .catch((error) => {
  
          this.setState({
            loading: false
          })
          console.log(error)
        });
      }   
    else{
      alert("Enter username & password");
    }
  }

  render() {
    const { navigate } = this.props.navigation;
    const { username, password, loading } = this.state;
    return (
        <View style={styles.container}>
          <View style={styles.logo}>
            <Image style={styles.logotipo}
              source={require('../assets/splash.png')}
            />
          </View>
        <View style={styles.inputView} >
          <Input
            placeholder=' Email...'
            leftIcon={
              <FontAwesomeIcons
                name='user'
                size={24}
                color='#810053'
              />
            }
            value={username}
            onChangeText={(text)=>this.setState({username:text})}
          />
          <Input
            placeholder=' Password...'
            secureTextEntry={true}
            leftIcon={
              <FontAwesomeIcons
                name='key'
                size={18}
                color='#810053'
              />
            }
            value={password}
            onChangeText={(text)=>this.setState({password:text})}
          />
        </View>
        <View style={styles.containerBtn}>
          <TouchableOpacity onPress={() => AsyncStorage.removeItem('token')}>
            <Text style={styles.recoverPassword}>Recuperar Password</Text>
          </TouchableOpacity>
          <TouchableOpacity activeOpacity={0.8} style={{...styles.loginBtn,
              backgroundColor: loading ? "#ddd" : "#810053"
            }} onPress={() => this.loginFunction()}
            disabled={loading}
            >
            <Text style={styles.loginTextbtn}>{loading ? "Loading...": "Login"}</Text>
          </TouchableOpacity>
          <TouchableOpacity onPress={() => AsyncStorage.getItem('token', (err, result) => {console.log("token ->",result);})}>
            <Text style={styles.registerText}>Registar</Text>
          </TouchableOpacity>
        </View>
      </View>
    );
  };
}

// #810053
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: 'white',
    alignItems: 'center',
    justifyContent: 'center',
    flexShrink: 2,
    margin: 5,
  },

  logo: {
    flex: 3,
    width: '110%'
  },
  containerBtn: {
    flex: 2,
    justifyContent: "center",
    alignItems: 'center',   
  },

  inputView: {
    width: "80%",
    backgroundColor: "white",
    borderRadius: 10,
    alignItems: 'center',
    padding: 5,
    flex: 1,    
  },

  inputText: {
    height: 50,
    color: "black"
  },

  recoverPassword: {
    color: "black",
    fontSize: 11
  },

  loginBtn: {
    width: 200,
    backgroundColor: "#810053",
    borderRadius: 25,
    height: 50,
    alignItems: "center",
    justifyContent: "center",
    marginTop: 20,
    marginBottom: 10

  },

  registerText: {
    color: "black"
  },

  loginTextbtn: {
    color: "white"
  },

  logotipo: {
    height: '100%',
    width: 430,
    alignItems: 'center',
  }

});

