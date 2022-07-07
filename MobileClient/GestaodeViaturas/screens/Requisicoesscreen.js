import React, { Component, Fragment } from "react";
import {
  Modal,
  StyleSheet,
  SafeAreaView,
  Button,
  Text,
  View,
  FlatList,
  ImageBackground,
} from "react-native";
import { AsyncStorage,TouchableOpacity } from "react-native";
import { ListItem } from "react-native-elements";
import base64 from "react-native-base64";

class RequisicoesScreen extends React.Component {
  constructor(props) {
    super(props);
    this.checkToken();
    this.state = {
      isVisible: false,
      id: "",
      token: "",
      utilizadorId:"",
      requisicoes: [],
    };
  }
  checkToken = async () => {
    this.state.token = await AsyncStorage.getItem("token");
    this.state.utilizadorId = await AsyncStorage.getItem("nome");};

  
  rejeitarReq(id) {
    var details = {
      'validacao_id': 2,
      'utilizador_id': 1,
    };

    var formBody = [];
    for (var property in details) {
      var encodedKey = encodeURIComponent(property);
      var encodedValue = encodeURIComponent(details[property]);
      formBody.push(encodedKey + "=" + encodedValue);
    }
    formBody = formBody.join("&");

    const idstring = id.toString();

    const URL = "http://192.168.1.113/grupo4-pws/web/api-v1/requisicaos/" + idstring;
console.log("URL TESTE",URL)
    fetch(URL, {
      method: "PUT",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        authorization: "Basic " + base64.encode(this.state.token + ":"),
      },
      body: formBody,
    })
      .then((response) => response.json())
      .then((responseJson) => {
      })
      .catch((error) => {
        console.error(error);
      });
      this.componentDidMount();
  }

  aprovarReq(id) {
    
    var details = {
      'validacao_id': 1,
      'utilizador_id': 1,
    };
    console.log("ID ULTIZADOR",this.state.utilizadorId)
    console.log("TOKEN ULTIZADOR",this.state.token)

    var formBody = [];
    for (var property in details) {
      var encodedKey = encodeURIComponent(property);
      var encodedValue = encodeURIComponent(details[property]);
      formBody.push(encodedKey + "=" + encodedValue);
    }
    formBody = formBody.join("&");

    const idstring = id.toString();
    const URL = "http://192.168.1.113/grupo4-pws/web/api-v1/requisicaos/" + idstring;
    fetch(URL, {
      method: "PUT",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
        authorization: "Basic " + base64.encode(this.state.token + ":"),
      },
      body: formBody,
    })
      .then((response) => response.json())
      .then((responseJson) => {
      })
      .catch((error) => {
        console.error(error);
      });
      this.componentDidMount();
  }

  componentDidMount() {
    return fetch(
      "http://192.168.1.113/grupo4-pws/web/api-v1/requisicao/disponivel",
      {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          Authorization: "Basic " + base64.encode(this.state.token + ":"),
        },
      }
    )
      .then((response) => response.json())
      .then((responseJson) => {
        this.setState({ requisicoes: responseJson });
      })
      .catch((error) => {
        console.error(error);
      });
     
  }

  pressHandler = (id) => {
    this.setState({ isVisible: true, id });
  };

  render() {
    const { navigate } = this.props.navigation;

    let carroselecionado = {};

    if (this.state.isVisible) {
      carroselecionado = this.state.requisicoes[0].find(
        (item) => item.id === this.state.id
      );
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
            data={this.state.requisicoes[0]}
            renderItem={({ item }) => (
              <TouchableOpacity
                id={item.id}
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
                      <Bold>Motivo da Requisição: </Bold>
                      {item.motivo_requisicao}
                    </Text>
                    <Text style={styles.textoautomatico}>
                      <Bold>Data da Requisição: </Bold>
                      {item.data_req}
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
                  <Text style={styles.textoautomatico}>
                    <Bold>Veículo: </Bold>
                    {carroselecionado.veiculo_id}
                  </Text>
                  <Text style={styles.textoautomatico}>
                    <Bold>Data de Requisição: </Bold>
                    {carroselecionado.data_req}
                  </Text>
                  <Text style={styles.textoautomatico}>
                    <Bold>Data de Saída: </Bold>
                    {carroselecionado.data_req_saida}
                  </Text>
                  <Text style={styles.textoautomatico}>
                    <Bold>Motivo: </Bold>
                    {carroselecionado.motivo_requisicao}
                  </Text>
                  <Text style={styles.textoautomatico}>
                    <Bold>Estado: </Bold>
                    {carroselecionado.validacao_id}
                  </Text>
                  <Text style={styles.textoautomatico}>
                    <Bold>Quilómetros Chegada: </Bold>
                    {carroselecionado.km_chegada}
                  </Text>
                  <Text style={styles.textoautomatico}>
                    <Bold>Quilómetros Saida: </Bold>
                    {carroselecionado.km_saida}
                  </Text>
                </View>
              </View>
              <View
                style={{
                  justifyContent: "center",
                  alignItems: "center",
                  padding: 5,
                }}
              >
                <TouchableOpacity
                  style={styles.btnrequisitar}
                  onPress={() => {
                    this.setState({ isVisible: false });
                  }}
                >
                  <Text style={styles.botaotext}>Retroceder</Text>
                </TouchableOpacity>
              </View>
              <View
                style={{
                  flexDirection: "row",
                  justifyContent: "center",
                  alignItems: "center",
                  padding: 5,
                }}
              >
                <TouchableOpacity
                  style={styles.btnAceitar}
                  onPress={() => {
                    this.aprovarReq(carroselecionado.id);
                    this.setState({ isVisible: false });
                  }}
                >
                  <Text style={styles.botaotext}>Aceitar</Text>
                </TouchableOpacity>
                <TouchableOpacity
                  style={styles.btnRegeitar}
                  onPress={() => {
                    this.rejeitarReq(carroselecionado.id);
                    this.setState({ isVisible: false });
                  }}
                >
                  <Text style={styles.botaotext}>Rejeitar</Text>
                </TouchableOpacity>
              </View>
            </View>
          </Modal>
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
    fontWeight: 'bold'
  },

  modal: {
    padding: 10,
    flex:1,
  },
  btnrequisitar: {
    width: "40%",
    backgroundColor: "#810053",
    borderRadius: 10,
    height: 50,
    alignItems: "center",
    justifyContent: "center",
    fontSize: 10,
  },
  btnRegeitar: {
    width: "40%",
    backgroundColor: "#810053",
    borderRadius: 10,
    height: 50,
    marginLeft: 10,
    alignItems: "center",
    justifyContent: "center",
    fontSize: 10,
  },
  btnAceitar: {
    width: "40%",
    backgroundColor: "#810053",
    borderRadius: 10,
    height: 50,
    marginRight: 10,
    alignItems: "center",
    justifyContent: "center",
    fontSize: 10,
  },
  itemlist: {
   flex:3,
    borderBottomColor: "#830053",
  },
  container: {
    backgroundColor: "white",
  },
});

export default RequisicoesScreen;
