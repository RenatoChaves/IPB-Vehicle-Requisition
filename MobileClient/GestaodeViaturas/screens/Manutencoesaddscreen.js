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
import { AsyncStorage, Alert } from "react-native";
import { ListItem } from "react-native-elements";
import { Formik } from "formik";
import { TouchableOpacity } from "react-native";
import base64 from "react-native-base64";

export default class adicionarManutencaoScreen extends React.Component {
  state = {
    token: "",
    manutencao: [],
    isVisible: false,
    id: "",
  };
  //VEICULOS
  componentDidMount() {
    const idveiculo = this.props.route.params;
    const id2 = idveiculo.veiculoid;
    const url1 = id2.toString();

    var url =
      "http://192.168.1.113/grupo4-pws/web/api-v1/manutencao/manutencao?id=" +
      url1;
    fetch(url, {
      method: "GET",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json",
        authorization: "Basic " + base64.encode(this.state.token + ":"),
      },
    })
      .then((response) => response.json())
      .then((responseJson) => {
        if (responseJson !== null) {
          this.setState({ manutencao: responseJson });
          console.log("Resposta Manutencao ", responseJson);
        } else {
          Alert.alert("Não existem manutenções deste veículo");
        }
      })
      .catch((error) => {
        console.error(error);
      });
  }
  pressHandler = (id) => {
    this.setState({ isVisible: true, id });
  }

  render() {
    const { navigate } = this.props.navigation;

    let carroselecionado = {};

    if (this.state.isVisible) {
      console.log("key", this.state.id);
      carroselecionado = this.state.manutencao.find(
        (item) => item.id === this.state.id
      );
      console.log("carroselecionado", carroselecionado);
    }

    const Bold = ({ children }) => (
      <Text style={{ fontWeight: "bold", color: "#830053", fontSize: 18 }}>
        {children}
      </Text>
    );
    return (
      <Fragment>
        <SafeAreaView style={styles.container}>
          <FlatList
            itemDimension={100}
            data={this.state.manutencao}
            renderItem={({ item }) => (
              <TouchableOpacity
                id={carroselecionado.id}
                onPress={() => this.pressHandler(item.id)}
                style={styles.itemlist}
              >
                <View style={{ borderWidth: 5, borderColor: "white" }}>
                  <View
                    style={{
                      borderRadius: 15,
                      backgroundColor: "#F8E5F1",
                      padding: 10,
                    }}
                  >
                    <Text style={styles.textoautomatico}>
                      <Bold>Data da Manutenção: </Bold>
                      {item.data}
                    </Text>
                    <Text style={styles.textoautomatico}>
                      <Bold>Observações: </Bold>
                      {item.observacoes}
                    </Text>
                  </View>
                </View>
              </TouchableOpacity>
            )}
          />
          <Modal
            animationType={"slide"}
            transparent={false}
            visible={this.state.isVisible}
            onRequestClose={() => {
              this.setState({ isVisible: false });
            }}
          >
            <View style={styles.modal}>
              <View style={{ flex: 1, backgroundColor: "white" }}>
                <View
                  style={{
                    flex: 2,
                    justifyContent: "center",
                    alignItems: "center",
                  }}
                >
                  <ImageBackground
                    style={{ width: 400, height: 250 }}
                    source={require("../assets/carrito.png")}
                  />
                </View>
                <View style={{ backgroundColor: "white", flex: 1 }}>
                     <Text style={styles.textoautomatico}><Bold>Manutenção nº: </Bold>{carroselecionado.id}</Text>
                        <Text style={styles.textoautomatico}><Bold>Data de Manutenção: </Bold>{carroselecionado.data}</Text>
                        <Text style={styles.textoautomatico}><Bold>Quilometros de Saida: </Bold>{carroselecionado.km_saida}</Text>
                        <Text style={styles.textoautomatico}><Bold>Quilometros de Chegada: </Bold>{carroselecionado.km_chegada}</Text>
                        <Text style={styles.textoautomatico}><Bold>Observações: </Bold>{carroselecionado.observacoes}</Text>
                        
                </View>
              </View>
              <View
                style={{
                  flexDirection: "row",
                  justifyContent: "center",
                  alignItems: "center",
                }}
              >
                <TouchableOpacity
                  style={styles.btnrequisitar}
                  onPress={() => {
                    this.setState({ isVisible: false });
                  }}
                >
                  <Text style={styles.botaotext}>Fechar</Text>
                </TouchableOpacity>
                
              </View>
            </View>
          </Modal>
          <View>
          <TouchableOpacity
                  style={styles.btnrequisitar}
                  onPress={() => {
                    this.props.navigation.navigate('manutencaoCreate', {veiculoid : carroselecionado.id});
                  }}
                >
                  <Text style={styles.botaotext}>Adicionar Manutenção</Text>
                </TouchableOpacity>
          </View>
        </SafeAreaView>
      </Fragment>
    );
  }
}

const styles = StyleSheet.create({
  textoautomatico: {
    color: "black",
    marginLeft: 5,
    fontSize: 17,
  },
  botaotext: {
    color: "white",
    marginLeft: 10,
    fontSize: 17,
    fontWeight: "bold",
  },

  modal: {
    padding: 10,
    flex: 1,
  },
  btnrequisitar: {
    width: "40%",
    backgroundColor: "#810053",
    borderRadius: 10,
    height: 50,
    marginLeft: 40,
    alignItems: "center",
    justifyContent: "center",
    fontSize: 10,
  },
  itemlist: {
    flex: 3,
    borderBottomColor: "#830053",
  },
  container: {
    backgroundColor: "white",
  },
});
