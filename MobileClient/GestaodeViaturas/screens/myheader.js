import React from "react";
import { Header } from "react-native-elements";

export const MyHeader = (props) => (
    <Header
        placement="right"
        rightComponent={{
            size: 30,
            icon: "menu",
            color: "#fff",
            onPress: () => {
                props.navigation.toggleDrawer();
            },
        }}
        backgroundColor="#810053"
        centerComponent={{ text: props.title, style: { color: "#fff" } }}
        containerStyle={{
            height: 50, paddingTop: 5, alignItems: "center",
            borderBottomLeftRadius: 3, borderBottomRightRadius: 3,
            }}
        />
);

