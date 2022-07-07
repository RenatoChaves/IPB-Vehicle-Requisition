import React from 'react';
import { StatusBar } from 'react-native';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import { createMaterialTopTabNavigator } from '@react-navigation/material-top-tabs';

import LoginScreen from './screens/Loginscreen.js';
import AuthLoadingScreen from './screens/AuthLoadingScreen.js';
import RegistarContaScreen from './screens/RegistarContascreen.js';

import FuncionarioNavigation from './screens/RoleBasedNavigation/FuncionarioNavigation.js';
import TecnicoNavigation from './screens/RoleBasedNavigation/TecnicoNavigation.js';
import RecepcionistaNavigation from './screens/RoleBasedNavigation/RecepcionistaNavigation.js';
import GestorNavigation from './screens/RoleBasedNavigation/GestorNavigation.js';
import AdministradorNavigation from './screens/RoleBasedNavigation/AdministradorNavigation.js';

const AuthTopTab = createMaterialTopTabNavigator();
const AuthTopTabScreen = () => (
  <AuthTopTab.Navigator
    tabBarOptions={{ activeTintColor: '#810053',
    inactiveTintColor: 'black',
    indicatorStyle: {backgroundColor:'#810053'}
    }}
    style={{ paddingTop: Platform.OS === 'android' ? StatusBar.currentHeight : 0 }}>
    <AuthTopTab.Screen
      name="Login"
      component={LoginScreen}
      options={{ title: "Login",
      showIcon: ({}) => (
        <Image
          source={require('./assets/manutencoes.png')}
          style={styles.iconsDrawer}
        />
      ) }}
    />
    <AuthTopTab.Screen
      name="Registo"
      component={RegistarContaScreen}
      options={{ title: "Registo" }}
    />
  </AuthTopTab.Navigator>
);

const BeforeSignIn = createStackNavigator();
const BeforeSignInScreen = () => (
  <BeforeSignIn.Navigator headerMode="none" initialRouteName="Login"
  style={{ paddingTop: Platform.OS === 'android' ? StatusBar.currentHeight : 0 }}>
      <BeforeSignIn.Screen
        name="Login"
        component={AuthTopTabScreen}
        options={{
          animationEnabled: false
        }}
      />
  </BeforeSignIn.Navigator>
);

const AppNavigatorStack = createStackNavigator();
export default function AppNavigator() {

    return (
        <NavigationContainer>
            <AppNavigatorStack.Navigator headerMode="none" initialRouteName="AuthLoadingScreen"
                style={{ paddingTop: Platform.OS === 'android' ? StatusBar.currentHeight : 0 }}>
                <AppNavigatorStack.Screen 
                name="Auth"
                component={BeforeSignInScreen}
            />
            <AppNavigatorStack.Screen
                name="AuthLoadingScreen"
                component={AuthLoadingScreen}
            />
            <AppNavigatorStack.Screen 
                name="funcionario"
                component={FuncionarioNavigation}
            />
            <AppNavigatorStack.Screen
                name="tecnicoManutencao"
                component={TecnicoNavigation}
            />
            <AppNavigatorStack.Screen
                name="recepcionista"
                component={RecepcionistaNavigation}
            />
            <AppNavigatorStack.Screen
                name="gestor"
                component={GestorNavigation}
            />
            <AppNavigatorStack.Screen
                name="administrador"
                component={AdministradorNavigation}
            />
            </AppNavigatorStack.Navigator>
        </NavigationContainer>
    )
};