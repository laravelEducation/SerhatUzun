import { divide } from 'lodash';
import { inject,observer } from 'mobx-react';
import React from 'react';


const Index = (props) =>{
   props.AuthStore.getToken();
   console.log(JSON.parse(props.AuthStore.appState));
    return <div> Burası Index Sayfası</div>
};

export default  inject("AuthStore")(observer(Index));
