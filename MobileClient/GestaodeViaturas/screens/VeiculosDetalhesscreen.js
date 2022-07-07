import React, { useState, Fragment } from "react";
import {
    StyleSheet,
    Text,
    View,
    TextInput,
    TouchableOpacity,
    Image,
    ImageBackground,
    AsyncStorage,
    FlatList,
} from "react-native";
import { Icon } from "react-native-elements";
import { Button, Header, Input } from "react-native-elements";
import { SectionGrid } from "react-native-super-grid";
import base64 from "react-native-base64";

export default class VeiculosDetalhesScreen extends React.Component {
    state = {
        token: "",
        veiculo: [],
    };
    //VEICULOS
    componentDidMount() {
        const id = this.props.route.params
        const id2 = id.veiculoid
        const url1 = id2.toString()

        var url = 'http://192.168.1.113/grupo4-pws/web/api-v1/veiculo/veiculo?id=' + url1
        fetch(
            url,
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
                this.setState({ veiculo: responseJson })
            })
            .catch((error) => {
                console.error(error);

            }); console.log(this.state.veiculo)
    }

    render() {
        const Bold = ({ children }) => <Text style={{ fontWeight: 'bold', color: '#830053', fontSize: 18 }}>{children}</Text>
        return (
            <View style={{ flex: 1, backgroundColor: "white" }}>
                <View style={{ flex: 2, justifyContent: 'center', alignItems: "center", }} >
                    <ImageBackground style={{ width: 400, height: 250 }} source={require("../assets/carrito.png")} />
                </View>
                <View style={{ backgroundColor: "white", flex: 1 }}>
                    <Text style={styles.textoautomatico}><Bold>Matricula: </Bold>{this.state.veiculo.matricula}</Text>
                    <Text style={styles.textoautomatico}><Bold>Cor: </Bold>{this.state.veiculo.cor}</Text>
                    <Text style={styles.textoautomatico}><Bold>Lugares: </Bold>{this.state.veiculo.lugares}</Text>
                    <Text style={styles.textoautomatico}><Bold>Capacidade: </Bold>{this.state.veiculo.capacidade_bagageira}</Text>
                    <Text style={styles.textoautomatico}><Bold>Marca: </Bold>{this.state.veiculo.marca}<Bold> : </Bold>{this.state.veiculo.modelo}</Text>
                    <Text style={styles.textoautomatico}><Bold>Tipo Combustivel: </Bold>{this.state.veiculo.tipocombustivel}</Text>
                </View>
            </View>
        )
    }
}

const styles = StyleSheet.create({

    textoautomatico: {
        color: 'black',
        marginLeft: 10,
        fontSize: 17,

    },

    textotitulo: {
        color: 'black',
        marginLeft: 10,
        fontSize: 17,
        fontWeight: 'bold'
    },

});