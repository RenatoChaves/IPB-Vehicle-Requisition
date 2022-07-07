import React from "react";
import {
  StyleSheet,
  Text,
  Item,
  View,
  TextInput,
  TouchableOpacity,
  Image,
  ImageBackground,
  FlatList,
  AsyncStorage,
} from "react-native";
import { Icon } from "react-native-elements";
import { Button, Header, Input } from "react-native-elements";
import { SectionGrid } from "react-native-super-grid";
import base64 from "react-native-base64";

export default class ManutencoesScreen extends React.Component {

  state = {
    veiculos: [],
  };
  /*Fetch json*/
  //VEICULOS
  componentDidMount() {
    fetch(
      "http://192.168.1.113/grupo4-pws/web/api-v1/veiculo/indisponivel",
      {
        method: "GET",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
          authorization: "Basic " + base64.encode(this.state.token + ":"),
        },
      }
    )
      .then((response) => response.json())
      .then((responseJson) => {
        this.setState({ veiculos: responseJson })
      })
      .catch((error) => {
        console.error(error);
      });
  }
  
  render() {
    return (
      <View style={styles.bottomContainer}>

        
        <FlatList
          itemDimension={100}
          data={this.state.veiculos[0]}
          renderItem={({ item }) => (
            <TouchableOpacity onPress={() => this.props.navigation.navigate("adicionarManutencao", { veiculoid: item.id })}>
              <View style={{ flex: 1, borderWidth: 5, borderColor: "white" }}>
                <View style={{  borderRadius: 15, backgroundColor: "#F8E5F1" }}>
                  <Text style={styles.itemName}>{item.matricula}</Text>
                  <ImageBackground
                    style={{ width: 170, height: 100, marginLeft: 100 }}
                    source={require("../assets/carrito.png")}
                  />
                </View>
              </View>
            </TouchableOpacity>
          )}
        />
      </View>
    );
  }
}

const styles = StyleSheet.create({

  itemName: {
    fontSize: 16,
    color: "black",
    fontWeight: "600",
    marginTop: -1,
    textAlign: "center",
  },

  bottomContainer: {
    flex: 3,
    backgroundColor: "white",
  },
});