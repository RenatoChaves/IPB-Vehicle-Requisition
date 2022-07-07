import React, { Component, Fragment } from "react";
import {
  Modal,
  StyleSheet,
  SafeAreaView,
  Button,
  Text,
  View,
  FlatList,
  
} from "react-native";
import { AsyncStorage } from "react-native";
import { ListItem , List} from "react-native-elements";
import { TouchableOpacity } from "react-native";
import base64 from "react-native-base64";

class HistoricoScreen extends Component {
  constructor(props) {
    super(props);
    this.state = {
      isVisible: false,
      id: "",
      token: "",
      requisicoes: [],
    };
  }

  getToken = async () => {
    try {
      const value = await AsyncStorage.getItem("token");
      if (value !== null) {
        this.setState({ token: value });
      }
    } catch (error) {}
  };

  componentDidMount() {
    return fetch(
      "http://192.168.1.113/grupo4-pws/web/api-v1/requisicao/reqid",
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

  async validarRequisicao(carroselecionado) {
    this.getToken();
    var details = {
      id: carroselecionado.id,
      data_req: carroselecionado.data_req,
      data_submit_req: carroselecionado.data_submit_req,
      motivo_requisicao: carroselecionado.motivo_requisicao,
      km_chegada: carroselecionado.km_chegada,
      utilizador_id: carroselecionado.utilizador_id,
      veiculo_id: carroselecionado.veiculo_id,
      validacao_id: 1,
    };

    var formBody = [];
    for (var property in details) {
      var encodedKey = encodeURIComponent(property);
      var encodedValue = encodeURIComponent(details[property]);
      formBody.push(encodedKey + "=" + encodedValue);
    }
    formBody = formBody.join("&");
    console.log("FORM BODY ", formBody);
    await fetch(
      "http://192.168.1.113/grupo4-pws/web/api-v1/requisicao",
      {
        Method: "PUT",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",

          Authorization: "Basic " + base64.encode(this.state.token + ":"),
        },
        body: formBody,
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
      console.log("key", this.state.id);
      carroselecionado = this.state.requisicoes.find(
        (item) => item.id === this.state.id
      );
      console.log("carroselecionado", carroselecionado);
    }

    return (
      <Fragment>
        <View>
          <Text style={styles.subtitulo}>Histórico de Requisições</Text>
        </View>

        <SafeAreaView style={styles.container}>
     
          <FlatList
            data={this.state.requisicoes}
            renderItem={({ item }) => (
           
              <TouchableOpacity
                id={item.id}
                onPress={() => this.pressHandler(item.id)}
                style={styles.itemlist}
              > 
             <ListItem
            roundAvatar
            title= {item.id}
            subtitle= {item.data_req}
            avatar= {"../assets/carrito.png"} >  
            

             </ListItem>
          
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
              <View style={styles.linhasmodal}>
                <Text style={styles.modaltopico}>Veículo:</Text>

                <Text style={styles.textoautomatico}>
                  {carroselecionado.veiculo_id}
                </Text>
              </View>

              <View style={styles.linhasmodal}>
                <Text style={styles.modaltopico}>Data de Requisição:</Text>

                <Text style={styles.textoautomatico}>
                  {carroselecionado.data_req}
                </Text>
              </View>

              <View style={styles.linhasmodal}>
                <Text style={styles.modaltopico}>Data de Saída:</Text>

                <Text style={styles.textoautomatico}>
                  {carroselecionado.data_req_saida}
                </Text>
              </View>

              <View style={styles.linhasmodal}>
                <Text style={styles.modaltopico}>Motivo:</Text>

                <Text style={styles.textoautomatico}>
                  {carroselecionado.motivo_requisicao}
                </Text>
              </View>

              <View style={styles.linhasmodal}>
                <Text style={styles.modaltopico}>Quilómetros Realizados:</Text>

                <Text style={styles.textoautomatico}>
                  {carroselecionado.km_realizados}
                </Text>
              </View>
              <TouchableOpacity
                onPress={() => this.validarRequisicao(carroselecionado)}
                style={styles.itemlist}
              >
                <Text style={styles.textoItem}>Validar</Text>
              </TouchableOpacity>
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
  itemlist: {
    marginBottom: 15,
    borderBottomWidth: 1,
    borderBottomColor: "#830053",
  },
  container: {
    backgroundColor: "white",
  },

  textoItem: {
    fontSize: 20,
    color: "black",
    marginLeft: 10,
    fontWeight: "bold",
  },

  textoSubItem: {
    fontSize: 16,
    color: "black",
    marginLeft: 10,
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
});

export default HistoricoScreen;

