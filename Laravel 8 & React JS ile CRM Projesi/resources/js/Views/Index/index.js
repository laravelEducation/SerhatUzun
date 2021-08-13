import { divide } from 'lodash';
import { inject,observer } from 'mobx-react';
import React from 'react';
import Layout from '../../Components/Layout/front.layout';


const Index = (props) =>{
   props.AuthStore.getToken();
   const logout = () =>{
     props.AuthStore.removeToken();
     props.history.push('/login');

   }
  
    return (
      <Layout>
        <div> Burası Index Sayfası </div>
      </Layout>
    )
};

export default  inject("AuthStore")(observer(Index));
