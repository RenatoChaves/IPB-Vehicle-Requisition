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
  View,
  TouchableHighlight,
} from "react-native";
import { AsyncStorage , Alert } from "react-native";
import { ListItem } from "react-native-elements";
import { Formik } from "formik";
import { TouchableOpacity } from "react-native";
import base64 from "react-native-base64";

class RequisitarScreen extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      isVisible: false,
      activeSlide: 0,
      users: [],

      token: "",
      data_saida: "",
      motivo: "",
      data_submit_req: "",
      km_chegada: "",
      utilizador_id: "",
      veiculo_id: "",
      validacao_id: "",
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

  async componentDidMount() {
    const value = await AsyncStorage.getItem("token");
    const { imagemcarro } = this.props.route.params;
    fetch(
      "http://192.168.1.113/grupo4-pws/web/api-v1/auth",

      {
        method: "GET",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          authorization: "Basic " + base64.encode(value + ":"),
        },
      }
    )
      .then((response) => response.json())
      .then((responseJson) => {
        this.setState({ users: responseJson });
      })
      .catch((error) => {
        console.error(error);
      });
  }

  async requisitarVeiculo() {
    const value = await AsyncStorage.getItem("token");
    const { imagemcarro } = this.props.route.params;
    console.log("username: ", this.state.users[0].id);
    var today = new Date().toString();

    var details = {
      data_req: this.state.data_saida,
      data_submit_req: "2020-12-01",
      motivo_requisicao: this.state.motivo,
      km_chegada: 1,
      utilizador_id: this.state.users[0].id,
      veiculo_id: imagemcarro.id,
      validacao_id: 3,
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
      "http://192.168.1.113/grupo4-pws/web/api-v1/requisicaos",

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
        Alert.alert("Requisição efetuada, aguarde validação.")
        this.setState({isVisible:false});
        this.props.navigation.navigate("Home");
    
      });
  }
  botaoRequisitar() {
    this.setState({ isVisible: true });

  }

  render() {
    const { navigate } = this.props.navigation;
    const { sliderRef } = this.state;
    const { imagemcarro } = this.props.route.params;

    return (
      <Fragment>
        <View>
          <Text style={styles.subtitulo}>
            Formulário de Requisição: {imagemcarro.matricula}
          </Text>
        </View>

        <Formik
       
        >
          {({ handleBlur}) => (
            <View style={styles.formikstyle}>

              
              <Text style={styles.formtext}>Data / Hora Pretendida </Text>
              <TextInput
                style={styles.inputstyle}
                placeholder={"Insira a Data  Pretendida"}
                onChangeText={(text) => {
                  this.setState({ data_saida: text });
                }}
                onBlur={handleBlur("Data de Saida")}
                value={this.state.data_saida}
              />
              <Text style={styles.formtext}>Motivo de Requisição </Text>

              <TextInput
                style={styles.inputstyle}
                placeholder={"Insira o Motivo"}
                onChangeText={(text) => {
                  this.setState({ motivo: text });
                }}
                onBlur={handleBlur("motivo")}
                value={this.state.motivo}
              />

              <Modal
                animationType={"slide"}
                transparent={false}
                visible={this.state.isVisible}
                onRequestClosE={() => {
                  this.setState({ isVisible: false });
                }}
              >
                <View style={styles.modal}>

                <View style={styles.linhasmodal}>
                <Text style={styles.modaltopico}>Pretende confirmar a requisição do veículo?</Text>
                 
                  </View>
                  <View style={styles.linhasmodal}>
                    <Text style={styles.modaltopico}>Data Pretendida:</Text>
                    <Text style={styles.textoautomatico}>
                      {this.state.data_saida}
                    </Text>
                  </View>
                  <View style={styles.linhasmodal}>
                    <Text style={styles.modaltopico}>
                      Motivo de Requisição:
                    </Text>
              <Text style={styles.textoautomatico}>{this.state.motivo}</Text>
                  </View>

                 
                  <TouchableOpacity
                    style={styles.btnrequisitar}
                    onPress={() => this.requisitarVeiculo()}
                    title="Confirmar"   
                  >
                    <Text style={styles.btnconfirmar}>Confirmar</Text>
                  </TouchableOpacity>
                  <TouchableOpacity
                    style={styles.btnrequisitar}
                    onPress={() => {
                      this.setState({ isVisible: false });
                    }}
                    title="Cancelar"
                  >
                    <Text style={styles.btncancelar}>Cancelar</Text>
                  </TouchableOpacity>
                </View>
              </Modal>
              <TouchableOpacity
                style={styles.btnrequisitar}
                onPress={() => {
                  this.botaoRequisitar();
                }}
                title="Requisitar"
              >
                <Text style={styles.btntext}>Requisitar </Text>
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

export default RequisitarScreen;
