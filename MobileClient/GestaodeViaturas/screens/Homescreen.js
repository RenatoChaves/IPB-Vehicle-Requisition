import React, { Component } from "react";
import { StyleSheet, View, Text, SafeAreaView, TouchableOpacity, ImageBackground, } from "react-native";
import Carousel, {Pagination} from 'react-native-snap-carousel';
import base64 from "react-native-base64";

class HomeScreen extends Component {

  constructor(props) {
    super(props);
    this.state = {
      activeSlide:0,
      token: "",
      veiculos: [],

      carouselItems: [
      {
          title:"Fiat Cinquecento",
          text: "Text 1",
          image: require('../assets/fiatcinquecento.jpg'),
          textCombustivel: "Gasolina",
          textLugares: "4",
      },
      {
          title:"Opel Astra",
          text: "Text 2",
          image: require('../assets/opel_astra.jpg')
      },
      {
          title:"Opel Corsa",
          text: "Text 3",
          image: require('../assets/opel_corsa.jpg')
      },
      {
          title:"Item 4",
          text: "Text 4",
      },
      {
          title:"Item 5",
          text: "Text 5",
      },
      {
        title:"Item 6",
        text: "Text 6",
    },
    ]
  }
}

getToken = async () => {
  try {
    const value = await AsyncStorage.getItem("token");
    if (value !== null) {
      this.setState({ token: value })
    }
  } catch (error) {

  }
};

componentDidMount() {
 
  return fetch("http://192.168.1.113/grupo4-pws/web/api-v1/veiculo/disponivel", {
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      Authorization: "Basic " + base64.encode(this.state.token + ":"),

    }
  })
    .then(response => response.json())
    .then((responseJson) => {
      this.setState({veiculos:responseJson[0]})
      console.log(responseJson)
    
    })
    .catch((error) => {
      console.error(error);
    })
}


_renderItem({item}){

  return (
    <SafeAreaView>
      <View style={styles.viewStyle}>
        <ImageBackground
          style={ styles.imagens}
          source = {require('../assets/carrito.png')}>
        </ImageBackground>
        <Text style={styles.textoCarros}>{item.matricula}</Text>
      </View>  
    </SafeAreaView>
  )
}
//this.props.navigation.navigate('Requisitar',{title: carouselItems[].title

  render() {
    const { navigate } = this.props.navigation;
    const { veiculos, activeSlide } = this.state;
    const { sliderCarrosRef } = this.state;
   /*  console.log("veiculos - home", veiculos.home); */
    //const {pathtoheaven} = this.state.sliderCarrosRef._carouselRef._component._listRef._cellRefs
    return (
      <SafeAreaView style={styles.safeAreaViewStyle}>
          <View style={styles.carouselViewStyle}>
              <TouchableOpacity  style={styles.carouselViewStyle} onPress={()=> { this.props.navigation.navigate('Requisitar', {imagemcarro: veiculos[activeSlide]})}}>  
                <Carousel
                  ref={(c) => { if (!this.state.sliderCarrosRef) { this.setState({ sliderCarrosRef: c }); } }}
                  layout={"default"}
                  layoutCardOffset={18}
                  data={this.state.veiculos}
                  firstItem={0}
                  sliderWidth={300}
                  itemWidth={400}
                  renderItem={this._renderItem}
                  enableMomentum={false}
                  decelerationRate={"fast"}
                  onSnapToItem={(index) => this.setState({ activeSlide: index }) }
                 />
              </TouchableOpacity>
            </View>
            <View>
                <Pagination
                  dotsLength={veiculos.length}
                  activeDotIndex={activeSlide}
                  containerStyle={styles.paginationContainerStyle}
                  dotStyle={{
                    width: 10,
                    height: 10,
                    borderRadius: 5,
                    marginHorizontal: 8,
                    backgroundColor: '#810053'
                  }}
                  inactiveDotStyle={{
                  // Define styles for inactive dots here
                  }}
                  inactiveDotOpacity={0.4}
                  inactiveDotScale={0.6}
                  carouselRef={sliderCarrosRef}
                  tappableDots={!!sliderCarrosRef}
                />
            </View>
      </SafeAreaView>
    );
  }
}

const styles = StyleSheet.create({
  imagens: {
  flex: 1, 
  width: undefined, 
  height: undefined ,
  justifyContent: 'flex-end',
  alignItems: 'center',
  borderTopLeftRadius: 5,
  borderTopRightRadius: 5,
  borderBottomLeftRadius: 0,
  borderBottomRightRadius: 0,
  overflow: "hidden",
  position: "relative",
},
viewStyle: {
  backgroundColor:'floralwhite',
  borderTopLeftRadius: 5,
  borderTopRightRadius: 5,
  borderBottomLeftRadius: 0,
  borderBottomRightRadius: 0,
  height: 250,
  marginLeft: 25,
  marginRight: 25,
},
textoCarros: {
  textAlign: 'center',
  fontWeight: 'bold',
  fontSize: 20,
  color: 'black',
  borderBottomWidth: 2,
  borderRightWidth: 2,
  borderLeftWidth: 2,
  borderColor: '#810053',
  borderBottomLeftRadius: 5,
  borderBottomRightRadius: 5,
  backgroundColor: 'white',
},
safeAreaViewStyle:{
  flex: 1,
  backgroundColor:'white',
  paddingTop: 50,
},
carouselViewStyle:{
  flex: 1,
  flexDirection:'row',
  justifyContent: 'center',
},
paginationViewStyle:{
  marginBottom: 5,
},
paginationContainerStyle:{
  backgroundColor: 'white',
},
dadosViewStyle:{
  paddingTop: 20,
  flexDirection: 'row',
  justifyContent: "space-between",
  marginLeft: 100,
  marginRight: 100,
},
textoDados: {
  textAlign: 'center',
  fontWeight: 'bold',
  fontSize: 20,
  color: 'black',
  borderBottomWidth: 2,
  borderRightWidth: 2,
  borderLeftWidth: 2,
  borderColor: '#810053',
  borderBottomLeftRadius: 5,
  borderBottomRightRadius: 5,
  backgroundColor: 'white',
},
dadosTituloViewStyle:{
  paddingTop: 70,
  flexDirection: 'row',
  justifyContent: "space-between",
  marginLeft: 80,
  marginRight: 80,
},
gridView: {
  paddingTop: 20,
},
itemContainer: {
  justifyContent: 'flex-end',
  borderRadius: 5,
 // padding: 10,
  height: 150,
},
});

export default HomeScreen;