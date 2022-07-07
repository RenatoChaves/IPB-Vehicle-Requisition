import React, { Component, Fragment } from "react";
import {
  Button,
  Modal,
  Image,
  SafeAreaView,
  Container,
  StyleSheet,
  FormLabel,
  Form,
  FormInput,
  TextField,
  TextInput,
  ImageBackground,
  Text,
  FlatList,
  View,
  TouchableHighlight,
} from "react-native";
import { AsyncStorage , Alert } from "react-native";
import { ListItem } from "react-native-elements";
import { Formik } from "formik";
import { TouchableOpacity } from "react-native";
import base64 from "react-native-base64";

export default class manutencaoCreateScreen extends React.Component {
    state = {
        token: "",
        manutencao: [],
        isVisible: false,
        km_saida: '',
        km_chegada:'',
        observacoes:'',
        data_inspecao: '',
        
    };
    //VEICULOS
    
    async adicionarManutencao() {
        const value = await AsyncStorage.getItem("token");
        const { idveiculo } = this.props.route.params;
 
   
    console.log("ID VEICULO", idveiculo)
        var details = {
          data: "2020-12-01", //moment( new Date().format("YYYY-MM-DD")) ,         
          km_saida: this.state.km_saida,
          km_chegada: this.state.km_chegada,
          observacoes: this.state.observacoes,
          veiculo_id: 1,
          data_inspecao: this.state.data_inspecao,
          requisicao_id: 34,
          utilizador_id: 12,
        };
    
        var formBody = [];
        for (var property in details) {
          var encodedKey = encodeURIComponent(property);
          var encodedValue = encodeURIComponent(details[property]);
          formBody.push(encodedKey + "=" + encodedValue);
        }
        formBody = formBody.join("&");
        console.log("FORM BODY ", formBody);
    
        fetch(
          "http://192.168.1.113/grupo4-pws/web/api-v1/manutencaos",
    
          {
            method: "POST",
    
            headers: {
              "Content-Type": "application/x-www-form-urlencoded",
              authorization: "Basic " + base64.encode(value + ":"),
            },
    
            body: formBody,
          }
        )
          .then((response) => response.json())
          .then((responseJson) => {
            console.log("responseJson", responseJson);
            Alert.alert("Manutencao adicionada")
            this.setState({isVisible:false});
            this.props.navigation.navigate("adicionarManutencao");
        
          });
      }
    render() {
        const { navigate } = this.props.navigation;
        const { sliderRef } = this.state;
        const idveiculo = this.props.route.params;
      
    
        return (
          <Fragment>
        
    
            <Formik
           
            >
              {({ handleBlur}) => (
                <View style={styles.formikstyle}>
    
                  
                  <Text style={styles.formtext}>Quilometros de Saida </Text>
                  <TextInput
                    style={styles.inputstyle}
                    placeholder={"Insira os quilometros de saída"}
                    onChangeText={(text) => {
                      this.setState({km_saida: text });
                    }}
                 
                    value={this.state.km_saida}
                  />
                  <Text style={styles.formtext}>Quilometros de Chegada </Text>
    
                  <TextInput
                    style={styles.inputstyle}
                    placeholder={"Insira os quilometros de chegada"}
                    onChangeText={(text) => {
                      this.setState({ km_chegada: text });
                    }}
              
                    value={this.state.km_chegada}
                  />
    <Text style={styles.formtext}>Observações </Text>
    
    <TextInput
      style={styles.inputstyle}
      placeholder={"Observações"}
      onChangeText={(text) => {
        this.setState({ observacoes: text });
      }}

      value={this.state.observacoes}
    />
  <Text style={styles.formtext}>Data Inspeção </Text>
    
    <TextInput
      style={styles.inputstyle}
      placeholder={"Insira a data de inspeção"}
      onChangeText={(text) => {
        this.setState({ data_inspecao: text });
      }}

      value={this.state.data_inspecao}
    />

    
     <TouchableOpacity
                        style={styles.btnrequisitar}
                        onPress={() => this.adicionarManutencao()}
                        title="Adicionar"   
                      >
                        <Text style={styles.btnconfirmar}>Adicionar</Text>
                      </TouchableOpacity>
                
                
                </View>
              )}
            </Formik>
          </Fragment>
        );
      }
    }
    
    const styles = StyleSheet.create({
      textoautomatico: {
        color: "black",
        marginLeft: 10,
        fontSize: 17,
      },
    
      linhasmodal: {
        marginTop: 25,
        flexDirection: "row",
      },
    
      modaltopico: {
        color: "black",
        fontWeight: "bold",
        fontSize: 17,
      },
    
      container: {
        justifyContent: "flex-start",
        alignItems: "flex-start",
        marginLeft: 1,
      },
    
      botaosubmit: {
        color: "#830053",
      },
      modal: {
        alignItems: "flex-start",
        backgroundColor: "#e2c4d7",
        padding: 10,
        borderRadius: 10,
        borderColor: "#810053",
      },
    
      subtitulo: {
        color: "#830053",
        backgroundColor: "#e2c4d7",
        width: "auto",
        height: 35,
        textAlignVertical: "center",
        textAlign: "center",
        fontWeight: "bold",
        fontSize: 15,
      },
    
      imagens: {
        flex: 1,
        width: undefined,
        height: undefined,
        justifyContent: "flex-end",
        alignItems: "center",
        borderTopLeftRadius: 10,
        borderTopRightRadius: 10,
        borderBottomLeftRadius: 10,
        borderBottomRightRadius: 10,
        overflow: "hidden",
        position: "relative",
        marginTop: 30,
      },
    
      viewStyle: {
        borderTopLeftRadius: 5,
        borderTopRightRadius: 5,
        borderBottomLeftRadius: 0,
        borderBottomRightRadius: 0,
        height: 250,
        marginLeft: 25,
        marginRight: 25,
      },
    
      formikstyle: {
        marginRight: 10,
        marginLeft: 10,
      },
    
      inputstyle: {
        borderWidth: 1,
        borderColor: "#830053",
        padding: 10,
        fontSize: 18,
        borderRadius: 6,
      },
    
      formtext: {
        fontWeight: "bold",
        marginTop: 12,
        marginBottom: 5,
      },
    
      btnrequisitar: {
        width: "100%",
        backgroundColor: "#810053",
        borderRadius: 10,
        height: 50,
        marginTop: 40,
        alignItems: "center",
        justifyContent: "center",
        fontSize: 10,
      },
      btncancelar:{
        color: "white",
        fontWeight: "bold",
        flexDirection: "row",
      },
    btnconfirmar:{
      color: "white",
        fontWeight: "bold",
     
        flexDirection: "row",
    },
      btntext: {
        color: "white",
        fontWeight: "bold",
      },
    });
    