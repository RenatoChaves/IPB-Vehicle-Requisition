import React, { Component } from "react";
import { StyleSheet, View, Text, TouchableOpacity, ImageBackground } from "react-native";
import { FlatGrid } from 'react-native-super-grid';

class ContasScreen extends Component {
  constructor(props) {
    super(props);
  }
  
  render() {
    const items = [
      { name: 'Requisicoes', image: require('../assets/requisicoes.png'), title: 'Requisições' },
      { name: 'Veiculos', image: require('../assets/veiculos.png'), title: 'Veículos' },
      { name: 'Requisitar Veiculo', image: require('../assets/requisitarVeiculo.png'), title: 'Requisitar Veículo' },
      { name: 'Historico', image: require('../assets/historico.png'), title: 'Histórico' },
      { name: 'Contas', image: require('../assets/contas.png'), title: 'Contas' },
      { name: 'Manutencoes', image: require('../assets/manutencoes.png'), title: 'Manutenções'},
      { name: 'Perfil', image: require('../assets/perfil.png'), title: 'Perfil'},
      { name: 'Login', image: require('../assets/logout.png'), title: 'Sair'},
    ];

    return (
      <FlatGrid
        itemDimension={130}
        items={items}
        style={styles.gridView}

        renderItem={({ item, index }) => (
          <View style={[styles.itemContainer, { backgroundColor: item.code }]}>
            <TouchableOpacity
                onPress={() =>
                  this.props.navigation.navigate(item.name)
                }
                activeOpacity={0.8}
                style = {styles.imagens}
              >
                <ImageBackground
                  style={ styles.imagens}
                  source = {item.image}
                ><Text style = {styles.texto}>{item.title}</Text></ImageBackground>
              </TouchableOpacity>
            <Text style={styles.itemCode}>{item.code}</Text>
          </View>
        )}
      />
    );
  }
}

const styles = StyleSheet.create({
  gridView: {
    marginTop: 20,
    flex: 1,
  },
  itemContainer: {
    justifyContent: 'flex-end',
    borderRadius: 5,
   // padding: 10,
    height: 150,
  },
  itemName: {
    fontSize: 16,
    color: 'black',
    fontWeight: '600',
  },
  itemCode: {
    fontWeight: '600',
    fontSize: 12,
    color: '#fff',
  },
  imagens: {
    flex: 1, 
    width: 150, 
    height: 150,
    justifyContent: 'flex-end',
    alignItems: 'center',
  },
  texto: {
    textAlign: 'center',
    fontWeight: 'bold',
    fontSize: 15,
  }
});

export default ContasScreen;
