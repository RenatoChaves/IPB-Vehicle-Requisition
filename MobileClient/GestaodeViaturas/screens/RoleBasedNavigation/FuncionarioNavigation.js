import React from "react";

import {
  NavigationContainer,
  DrawerActions,
  useNavigation,
  StackActions,
} from "@react-navigation/native";
import {
  createDrawerNavigator,
  DrawerContentScrollView,
  DrawerItemList,
  DrawerItems,
} from "@react-navigation/drawer";
import { createStackNavigator } from "@react-navigation/stack";
import { createMaterialBottomTabNavigator } from "@react-navigation/material-bottom-tabs";

import FeatherIcons from "react-native-vector-icons/Feather";

import {
  AsyncStorage,
  Image,
  StyleSheet,
  ScrollView,
  SafeAreaView,
  TouchableOpacity,
  View,
  Text,
  StatusBar,
} from "react-native";

import HomeScreen from "../Homescreen.js";
import LoginScreen from "../Loginscreen.js";
import RequisicoesScreen from "../Requisicoesscreen.js";
import RequisitarScreen from "../Requisitarscreen.js";
import VeiculosScreen from "../Veiculosscreen.js";
import ContasScreen from "../Contasscreen.js";
import HistoricoScreen from "../Historicoscreen.js";
import ManutencoesScreen from "../Manutencoesscreen.js";
import PerfilScreen from "../Perfilscreen.js";
import Icon from "react-native-vector-icons/Ionicons";
import adicionarManutencaoScreen from "../Manutencoesaddscreen.js";
import manutencaoCreateScreen from "../Manutencoescreate.js";

import { DrawerContent } from "../CustomDrawer.js";
import VeiculosDetalhesScreen from "../VeiculosDetalhesscreen.js";

const Drawer = createDrawerNavigator();
const DrawerScreen = () => (
  <Drawer.Navigator
    initialRouteName="Voltar"
    drawerContent={(props) => <DrawerContent {...props} />}
    screenOptions={{
      headerStyle: {
        backgroundColor: "#810053",
      },
      headerTintColor: "#fff",
      headerTitleStyle: {
        fontWeight: "bold",
      },
    }}
    style={{
      paddingTop: Platform.OS === "android" ? StatusBar.currentHeight : 0,
    }}
  >
    <Drawer.Screen name="HomeTab" component={TabsScreen} />
    <Drawer.Screen name="Perfil" component={ProfileStackScreen} />
    <Drawer.Screen name="Historico" component={HistoricoScreen} />
  </Drawer.Navigator>
);

const Tabs = createMaterialBottomTabNavigator();
const TabsScreen = () => (
  <Tabs.Navigator
    barStyle={{ backgroundColor: "#810053" }}
    initialRouteName="Home"
    screenOptions={{
      headerStyle: {
        backgroundColor: "#810053",
      },
      headerTintColor: "#fff",
      headerTitleStyle: {
        fontWeight: "bold",
      },
    }}
    style={{
      paddingTop: Platform.OS === "android" ? StatusBar.currentHeight : 0,
    }}
  >
    <Tabs.Screen
      name="HomeStack"
      component={HomeStackScreen}
      options={{
        title: "Página Inicial",
        tabBarIcon: ({}) => (
          <FeatherIcons name="home" size={24} color="white" />
        ),
      }}
    />
    <Tabs.Screen
      name="VeiculosStack"
      component={VeiculosStackScreen}
      options={{
        title: "Veículos",
        tabBarIcon: ({}) => (
          <Image
            source={require("../../assets/veiculos.png")}
            style={styles.iconsBottomTab}
          />
        ),
        headerLeft: () => (
          <Icon.Button
            name="ios-menu"
            size={25}
            backgroundColor="#810053"
            onPress={() => navigation.openDrawer()}
          ></Icon.Button>
        ),
      }}
    />
  </Tabs.Navigator>
);

const VeiculosStack = createStackNavigator();
const VeiculosStackScreen = ({ navigation }) => (
  <VeiculosStack.Navigator
    initialRouteName="Veiculos"
    screenOptions={{
      headerStyle: {
        backgroundColor: "#810053",
      },
      headerTintColor: "#fff",
      headerTitleStyle: {
        fontWeight: "bold",
      },
    }}
    style={{
      paddingTop: Platform.OS === "android" ? StatusBar.currentHeight : 0,
    }}
  >
    <VeiculosStack.Screen
      name="Veiculos"
      component={VeiculosScreen}
      options={{
        title: "Veículos",
        headerLeft: () => (
          <Icon.Button
            name="ios-menu"
            size={25}
            backgroundColor="#810053"
            onPress={() => navigation.openDrawer()}
          ></Icon.Button>
        ),
      }}
    />
    <VeiculosStack.Screen
      name="VeiculosDetalhes"
      component={VeiculosDetalhesScreen}
      options={{
        title: "Detalhes do Veículo",
        headerLeft: () => (
          <Icon.Button
            name="ios-menu"
            size={25}
            backgroundColor="#810053"
            onPress={() => navigation.openDrawer()}
          ></Icon.Button>
        ),
      }}
    />
  </VeiculosStack.Navigator>
);

const HomeStack = createStackNavigator();
const HomeStackScreen = ({ navigation }) => (
  <HomeStack.Navigator
    initialRouteName="Home"
    screenOptions={{
      headerStyle: {
        backgroundColor: "#810053",
      },
      headerTintColor: "#fff",
      headerTitleStyle: {
        fontWeight: "bold",
      },
    }}
    style={{
      paddingTop: Platform.OS === "android" ? StatusBar.currentHeight : 0,
    }}
  >
    <HomeStack.Screen
      name="Home"
      component={HomeScreen}
      options={{
        title: "Página Inicial",
        headerLeft: () => (
          <Icon.Button
            name="ios-menu"
            size={25}
            backgroundColor="#810053"
            onPress={() => navigation.openDrawer()}
          ></Icon.Button>
        ),
      }}
    />
    <HomeStack.Screen
      name="Requisitar"
      component={RequisitarScreen}
      options={{
        title: "Requisitar Veículo",
        headerLeft: () => (
          <Icon.Button
            name="ios-menu"
            size={25}
            backgroundColor="#810053"
            onPress={() => navigation.openDrawer()}
          ></Icon.Button>
        ),
      }}
    />
  </HomeStack.Navigator>
);

const ProfileStack = createStackNavigator();
const ProfileStackScreen = ({ navigation }) => (
  <ProfileStack.Navigator
    initialRouteName="Perfil"
    screenOptions={{
      headerStyle: {
        backgroundColor: "#810053",
      },
      headerTintColor: "#fff",
      headerTitleStyle: {
        fontWeight: "bold",
      },
    }}
    style={{
      paddingTop: Platform.OS === "android" ? StatusBar.currentHeight : 0,
    }}
  >
    <ProfileStack.Screen
      name="Perfil"
      component={PerfilScreen}
      options={{
        title: "Perfil",
        headerLeft: () => (
          <Icon.Button
            name="ios-menu"
            size={25}
            backgroundColor="#810053"
            onPress={() => navigation.openDrawer()}
          ></Icon.Button>
        ),
      }}
    />
  </ProfileStack.Navigator>
);

class RecepcionistaNavigation extends React.Component {
  render() {
    return <DrawerScreen />;
  }
}

export default RecepcionistaNavigation;

const styles = StyleSheet.create({
  iconsBottomTab: {
    height: 24,
    width: 24,
    tintColor: "white",
  },
  iconsDrawer: {
    height: 24,
    width: 24,
    tintColor: "#810053",
  },
  drawerIconRight: {
    marginRight: 12,
    marginTop: 5,
  },
  drawerIconLeft: {
    marginLeft: 12,
    marginTop: 5,
  },
  item: {
    flexDirection: "row",
    alignItems: "center",
  },
  label: {
    margin: 16,
    fontWeight: "bold",
    color: "rgba(0, 0, 0, .87)",
  },
  iconContainer: {
    marginHorizontal: 16,
    width: 24,
    alignItems: "center",
  },
  icon: {
    width: 24,
    height: 24,
  },
});
