import React, { Component } from 'react';
import { ScrollView, StyleSheet, Text, View, Image, TouchableOpacity } from 'react-native';
import * as ImagePicker from 'expo-image-picker';

class PerfilScreen extends Component {
  constructor(props) {
    super(props);
    this.state={
      nome:"",
      apelido:"",
      email:"",
      numeroMecanografico:"",
      numeroBI:"",
    };
  }


  render() {

/*     async() {
      try {
        this.state.nome = await AsyncStorage.getItem("nome");
      }
      catch (exception) {
      }
    };
  
    getApelido = async()=> {
      try {
        this.state.apelido = await AsyncStorage.getItem("apelido");
      }
      catch (exception) {
      }
    };
    getEmail = async()=> {
      try {
        this.state.email = await AsyncStorage.getItem("email");
      }
      catch (exception) {
      }
    };
    getNumeroMecanografico = async()=> {
      try {
        this.state.numeroMecanografico = await AsyncStorage.getItem("numeroMecanografico");
      }
      catch (exception) {
      }
    };
    getNumeroBI = async()=> {
      try {
        this.state.numeroBI = await AsyncStorage.getItem("numeroBI");
      }
      catch (exception) {
      }
    };
 */  
    let { image } = this.state;
    return (
      <View style={styles.container}>
        <View style={styles.imageContainer}>
          
          <Image style={styles.backgroundImage} source={require('../assets/babyyoda.png')} />
          {image && <Image source={{ uri: image }} style={{ width: 650, height: 400, zIndex: 2, position:'absolute', justifyContent:'center' }} />}
          
        </View>
        <View style={styles.nameIcon}>
          <Text style={styles.name}>Baby Yoda</Text>
          <TouchableOpacity style={styles.buttonContainer} onPress={this._pickImage}>
            <Image style={styles.icon} source={require('../assets/add_image.png')} />
          </TouchableOpacity>
          <TouchableOpacity style={styles.buttonContainer2} >
            <Image style={styles.icon} source={require('../assets/editar.png')} />
          </TouchableOpacity>
      </View>
        <View style={styles.bodyContent}>
          <View style={styles.infoGroup}>
            <Text style={styles.titulo}>E-mail</Text>
            <Text style={styles.info}>a12345@starwars.ipb.pt</Text>
          </View>
          <View style={styles.infoGroup} >
            <Text style={styles.titulo}>Número Mecanográfico</Text>
            <Text style={styles.info}>a12345</Text>
          </View>
          <View style={styles.infoGroup}>
            <Text style={styles.titulo}>Número BI</Text>
            <Text style={styles.info}>123456789</Text>
            
          </View>
        </View>
      </View>
    );
  }
  componentDidMount() {
    this.getPermissionAsync();
  }

  getPermissionAsync = async () => {
    if (Constants.platform.ios) {
      const { status } = await Permissions.askAsync(Permissions.CAMERA_ROLL);
      if (status !== 'granted') {
        alert('Sorry, we need camera roll permissions to make this work!');
      }
    }
  };

  _pickImage = async () => {
    try {
      let result = await ImagePicker.launchImageLibraryAsync({
        mediaTypes: ImagePicker.MediaTypeOptions.All,
        allowsEditing: false,
        aspect: [4, 3],
        quality: 1,
      });
      if (!result.cancelled) {
        this.setState({ image: result.uri });
      }

      console.log(result);
    } catch (E) {
      console.log(E);
    }
  };
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
  },
  imageContainer: {

    flex: 4
  },
  backgroundImage: {
    maxWidth: '100%',
    maxHeight: '100%',
   zIndex:1,
    position:'relative'
  },
  nameIcon: {
    marginLeft: 10,
    marginTop: 330,
    zIndex: 3,
    position: 'absolute',
    
  },
  name: {
    fontSize: 45,
    color: "white",
    fontWeight: "bold",
  },
  buttonContainer: {
    marginLeft: '83%',
    marginBottom: '17%',
    height: 65,
    width: 65,
    borderRadius: 50,
    alignItems: 'center',
    justifyContent: 'center',
    backgroundColor: "#810053",
    shadowColor: '#810053',
    shadowOpacity: 10,
    elevation: 8,
    shadowRadius: 20,
    shadowOffset: { width: 1, height: 13 },
  },
  buttonContainer2: {
    marginLeft: '83%',
    height: 65,
    width: 65,
    borderRadius: 50,
    backgroundColor: "#810053",
    shadowColor: '#810053',
    alignItems: 'center',
    justifyContent: 'center',
    shadowOpacity: 10,
    elevation: 8,
    shadowRadius: 20,
    shadowOffset: { width: 1, height: 13 },
  },
  icon: {
    marginBottom: '15%',
    width: 35,
    height: 35,
  },
  bodyContent: {
    flex: 2,
    marginLeft: 10,
    flexDirection: 'column',
    justifyContent: 'space-around'
  },
  infoGroup: {
  },
  titulo: {
    fontSize: 17,
    color: "black",
    fontWeight: "bold",
  },
  info: {
    fontSize: 16,
    color: "grey",
  }
});

export default PerfilScreen;

